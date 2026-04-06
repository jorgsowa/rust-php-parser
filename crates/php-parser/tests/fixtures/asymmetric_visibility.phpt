===config===
min_php=8.5
===source===
<?php
class User {
    public protected(set) string $name;
    public private(set) int $age;
    protected private(set) string $email = '';
}
