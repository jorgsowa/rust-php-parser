===source===
<?php
class Point {
    public function __construct(
        public readonly int $x,
        public private(set) int $y,
        protected int $z = 0,
    ) {}
}
