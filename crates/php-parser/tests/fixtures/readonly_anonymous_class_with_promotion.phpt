===source===
<?php
$obj = new readonly class(1, 2) {
    public function __construct(
        public int $x,
        public int $y,
    ) {}
};
