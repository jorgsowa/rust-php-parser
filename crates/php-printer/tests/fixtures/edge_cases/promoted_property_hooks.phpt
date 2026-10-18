===source===
<?php
class A {
    public function __construct(
        public int $a { get => 1; },
        public string $b = '' { set(string $v) { $this->b = $v; } },
    ) {}
}
===print===
<?php
class A
{
    public function __construct(
        public int $a {
            get => 1;
        },
        public string $b = '' {
            set(string $v) {
                $this->b = $v;
            }
        },
    )
    {}
}
