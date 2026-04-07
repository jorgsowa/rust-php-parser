===source===
<?php class Foo {
    public function bad(int ) {}
    public function good(): string { return 'ok'; }
}
===errors===
expected variable, found ')'
