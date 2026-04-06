===source===
<?php
enum Status {
    case Active;
    case Inactive;

    public function list(): array { return []; }
    public function match(): string { return ''; }
    public function switch(): void {}
}
