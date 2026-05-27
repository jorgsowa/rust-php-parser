===source===
<?php
class Foo
{
    public string $name {
        get
        // comment between get and {
        {
            return $this->name;
        }
    }
}
===print===
<?php
class Foo
{
    public string $name {
        get
        // comment between get and {
        {
            return $this->name;
        }
    }
}
