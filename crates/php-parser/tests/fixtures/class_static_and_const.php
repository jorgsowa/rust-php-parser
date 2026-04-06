<?php
class Config {
    public const VERSION = '1.0';
    private const DEBUG = false;
    public static int $count = 0;
    public static function increment(): void {
        self::$count++;
    }
}
