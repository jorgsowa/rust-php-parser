===source===
<?php enum Status: string { case Active = 'a'; const DEFAULT = self::Active; }
===print===
<?php
enum Status: string
{
    case Active = 'a';

    const DEFAULT = self::Active;
}
