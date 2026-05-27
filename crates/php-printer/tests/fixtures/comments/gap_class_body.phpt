===source===
<?php
class Foo extends Bar implements Baz
// comment before class body
{
    public int $x = 1;
}
===print===
<?php
class Foo extends Bar implements Baz
// comment before class body
{
    public int $x = 1;
}
