===source===
<?php
function processData(Countable&ArrayAccess $data): array|null {
    return null;
}
class Container {
    public function __construct(
        public readonly Countable&Iterator $items,
        private string|int|float $value
    ) {}
}
