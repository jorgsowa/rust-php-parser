===source===
<?php
trait Foo
// comment before trait body
{
    public function bar(): void {}
}
===print===
<?php
trait Foo
// comment before trait body
{
    public function bar(): void
    {}
}
