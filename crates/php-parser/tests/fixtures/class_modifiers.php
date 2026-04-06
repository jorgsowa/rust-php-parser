<?php
abstract class Base {
    abstract public function doSomething(): void;
}
final class Sealed {
    public function run(): void {}
}
readonly class Value {
    public function __construct(
        public string $name,
        public int $age,
    ) {}
}
