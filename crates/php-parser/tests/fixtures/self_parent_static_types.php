===source===
<?php
class Builder {
    public function setName(string $name): self { return $this; }
    public static function create(): static { return new static(); }
}
