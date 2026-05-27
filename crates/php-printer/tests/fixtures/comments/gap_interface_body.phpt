===source===
<?php
interface Foo extends Bar
// comment before interface body
{
    public function doSomething(): void;
}
===print===
<?php
interface Foo extends Bar
// comment before interface body
{
    public function doSomething(): void;
}
