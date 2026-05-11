===source===
<?php class User {
    public private(set) string $name;
    protected protected(set) int $age = 0;
    public function set(string $email) {}
}
===print===
<?php
class User
{
    public private(set) string $name;

    protected protected(set) int $age = 0;

    public function set(string $email)
    {}
}
