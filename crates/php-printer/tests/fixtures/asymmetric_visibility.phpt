===source===
<?php class User {
    public private(set) string $name;
    protected protected(set) int $age = 0;
    public function set(public private(set) string $email) {}
}
===print===
class User
{
    public private(set) string $name;

    protected protected(set) int $age = 0;

    public function set(public private(set) string $email)
    {}
}
