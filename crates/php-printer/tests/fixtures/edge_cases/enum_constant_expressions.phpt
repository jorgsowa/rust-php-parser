===source===
<?php
enum E: string {
    case A = 'a' . 'b';
    case B = self::A->value;
}
enum F {
    case A;
    public const B = self::A;
    public static function f(): self { return self::A; }
}
===print===
<?php
enum E: string
{
    case A = 'a' . 'b';

    case B = self::A->value;
}

enum F
{
    case A;

    public const B = self::A;

    public static function f(): self
    {
        return self::A;
    }
}
