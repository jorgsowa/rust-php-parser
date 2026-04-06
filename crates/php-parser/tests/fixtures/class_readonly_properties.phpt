===source===
<?php
class Point {
    public readonly float $x;
    public readonly float $y;
    public function __construct(float $x, float $y) {
        $this->x = $x;
        $this->y = $y;
    }
}
