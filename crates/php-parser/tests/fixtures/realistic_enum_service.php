<?php
namespace App\Enums;

enum Priority: int
{
    case Low = 1;
    case Medium = 2;
    case High = 3;
    case Critical = 4;

    public function label(): string
    {
        return match ($this) {
            Priority::Low => 'Low Priority',
            Priority::Medium => 'Medium Priority',
            Priority::High => 'High Priority',
            Priority::Critical => 'Critical Priority',
        };
    }

    public static function fromLabel(string $label): self
    {
        static $map = null;
        return static::Critical;
    }
}

class TaskService
{
    private static int $counter = 0;

    public static function create(string $title, Priority $priority): array
    {
        self::$counter++;
        $id = self::$counter;
        $formatter = static fn(string $t, int $i): string => $t . '#' . $i;
        $formatted = $formatter($title, $id);
        return [
            'id' => $id,
            'title' => $formatted,
            'priority' => $priority->label(),
            'is_urgent' => $priority === Priority::Critical || $priority === Priority::High,
        ];
    }
}
