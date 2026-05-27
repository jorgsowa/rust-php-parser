===source===
<?php
class Foo
{
    use Bar
    // comment between use Bar and {
    {
        Bar::hello insteadof Baz;
    }
}
===print===
<?php
class Foo
{
    use Bar
    // comment between use Bar and {
    {
        Bar::hello insteadof Baz;
    }
}
