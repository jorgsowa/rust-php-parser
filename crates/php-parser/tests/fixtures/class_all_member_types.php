<?php
abstract class Complete {
    use SomeTrait;

    public const MAX = 100;
    protected const MIN = 0;

    public string $name;
    protected int $age = 0;
    private static array $instances = [];
    public readonly string $id;

    public function __construct(string $name, public readonly int $score) {
        $this->name = $name;
    }

    public static function create(): self {
        return new self('default');
    }

    abstract protected function validate(): bool;

    final public function getId(): string {
        return $this->id;
    }
}
