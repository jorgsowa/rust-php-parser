<?php
enum Direction implements HasLabel {
    use LabelTrait;
    case North;
    case South;
    case East;
    case West;
}
