===source===
<?php
class Foo {
    public function __construct(
        public string $name {
            get => strtoupper($this->name);
            set(string $value) { $this->name = trim($value); }
        },
    ) {}
}
