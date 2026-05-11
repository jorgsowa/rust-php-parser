===source===
<?php interface Foo extends Bar, Baz { public function hello(): void; }
===print===
<?php
interface Foo extends Bar, Baz
{
    public function hello(): void;
}
