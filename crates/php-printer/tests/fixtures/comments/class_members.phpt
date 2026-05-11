===source===
<?php
class Foo {
    // comment before property
    public $x = 1;
    // comment between members
    public function bar() {
        echo 1;
    }
    // comment after method
}
===print===
<?php
class Foo
{
    // comment before property
    public $x = 1;
    // comment between members
    public function bar()
    {
        echo 1;
    }
    // comment after method
}
