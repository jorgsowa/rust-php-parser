===source===
<?php enum Status: string { case Active = 'a'; const DEFAULT = self::Active; }
===print===
enum Status: string
{
    case Active = 'a';

    const DEFAULT = self::Active;
}
