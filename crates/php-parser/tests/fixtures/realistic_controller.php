<?php
namespace App\Controllers;

use App\Models\User;
use App\Services\AuthService as Auth;

class UserController extends BaseController implements JsonResponder
{
    private readonly AuthService $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function show(int $id): array
    {
        try {
            $user = User::find($id) ?? throw new NotFoundException('User not found');
            $role = match ($user->role) {
                'admin' => 'Administrator',
                'editor' => 'Editor',
                default => 'User',
            };
            $data = [
                'name' => $user->name,
                'email' => $user?->email,
                'role' => $role,
            ];
            return $data;
        } catch (NotFoundException $e) {
            return ['error' => $e->getMessage()];
        } finally {
            $this->auth->logAccess($id);
        }
    }

    public function list(): array
    {
        $users = User::all();
        $names = array_map(fn($u) => $u->getName(), $users);
        $filtered = array_filter($names, function($name) use ($users) {
            return strlen($name) > 0;
        });
        return $filtered;
    }
}
