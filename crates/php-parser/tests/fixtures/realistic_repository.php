<?php
declare(strict_types=1);

namespace App\Repository;

use App\Models\User;
use App\Database\Connection as DB;
use function App\Helpers\sanitize;

interface RepositoryInterface
{
    public function find(int $id): ?User;
    public function findAll(): array;
    public function save(User $user): void;
    public function delete(int $id): void;
}

abstract class AbstractRepository
{
    protected readonly DB $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    abstract protected function tableName(): string;
    abstract protected function hydrate(array $row): object;

    final public function count(): int
    {
        $result = $this->db->query('SELECT COUNT(*) FROM ' . $this->tableName());
        return (int)$result[0];
    }
}

class UserRepository extends AbstractRepository implements RepositoryInterface
{
    use Cacheable, Loggable;

    public const PER_PAGE = 25;
    private static int $queryCount = 0;

    protected function tableName(): string
    {
        return 'users';
    }

    protected function hydrate(array $row): User
    {
        return new User(
            id: (int)$row['id'],
            name: $row['name'],
            email: $row['email'] ?? null,
        );
    }

    public function find(int $id): ?User
    {
        self::$queryCount++;
        $rows = $this->db->query('SELECT * FROM users WHERE id = ?');
        return isset($rows[0]) ? $this->hydrate($rows[0]) : null;
    }

    public function findAll(): array
    {
        self::$queryCount++;
        $rows = $this->db->query('SELECT * FROM ' . $this->tableName());
        return array_map(fn(array $row) => $this->hydrate($row), $rows);
    }

    public function findByEmail(string $email): ?User
    {
        $sanitized = sanitize($email);
        $users = $this->findAll();
        $filtered = array_filter(
            $users,
            function(User $u) use ($sanitized): bool {
                return $u->email === $sanitized;
            }
        );
        return $filtered[0] ?? null;
    }

    public function save(User $user): void
    {
        try {
            $this->db->query('INSERT INTO users VALUES (?)');
            $this->log('User saved: ' . $user->name);
        } catch (\PDOException $e) {
            $this->log('Save failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function delete(int $id): void
    {
        $user = $this->find($id) ?? throw new \RuntimeException('User not found');
        $this->db->query('DELETE FROM users WHERE id = ?');
        $this->log('User deleted: ' . $user->name);
    }

    public static function getQueryCount(): int
    {
        return self::$queryCount;
    }
}
