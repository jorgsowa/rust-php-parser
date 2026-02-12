<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use App\Auth\TokenValidator;
use App\Http\Request;
use App\Http\Response;

interface MiddlewareInterface
{
    public function handle(Request $request, callable $next): Response;
}

class AuthMiddleware implements MiddlewareInterface
{
    private readonly TokenValidator $validator;
    private static array $excludedPaths = [];

    public function __construct(TokenValidator $validator)
    {
        $this->validator = $validator;
    }

    public function handle(Request $request, callable $next): Response
    {
        $path = $request->getPath();

        foreach (self::$excludedPaths as $excluded) {
            if ($path === $excluded) {
                return $next($request);
            }
        }

        $token = $request->getHeader('Authorization') ?? '';
        $token = str_replace('Bearer ', '', $token);

        if (empty($token)) {
            return new Response(401, ['error' => 'Missing token']);
        }

        try {
            $claims = $this->validator->validate($token);
            $request->setAttribute('user_id', (int)$claims['sub']);
            $request->setAttribute('roles', $claims['roles'] ?? []);
        } catch (\InvalidArgumentException $e) {
            return new Response(401, ['error' => $e->getMessage()]);
        } catch (\RuntimeException | \LogicException $e) {
            @error_log('Auth error: ' . $e->getMessage());
            return new Response(500, ['error' => 'Internal error']);
        }

        return $next($request);
    }

    public static function exclude(string ...$paths): void
    {
        self::$excludedPaths = [...self::$excludedPaths, ...$paths];
    }
}

class RateLimitMiddleware implements MiddlewareInterface
{
    private const MAX_REQUESTS = 100;
    private const WINDOW_SECONDS = 60;

    public function handle(Request $request, callable $next): Response
    {
        $ip = $request->getIp();
        $key = 'rate:' . $ip;
        $count = $this->getCount($key);

        $remaining = self::MAX_REQUESTS - $count;
        $allowed = $remaining > 0;

        return match (true) {
            !$allowed => new Response(429, ['error' => 'Too many requests']),
            default => $next($request),
        };
    }

    private function getCount(string $key): int
    {
        static $counts = [];
        $counts[$key] = isset($counts[$key]) ? $counts[$key] + 1 : 1;
        return $counts[$key];
    }
}
