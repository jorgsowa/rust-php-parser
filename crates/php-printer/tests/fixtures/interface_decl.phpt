===source===
<?php interface Foo extends Bar, Baz { public function hello(): void; }
===print===
interface Foo extends Bar, Baz
{
    public function hello(): void;
}
