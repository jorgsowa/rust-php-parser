===source===
<?php
class User {
    public string $name;
    private int $age = 0;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }
}
