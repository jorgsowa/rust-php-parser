===source===
<?php class C {
    public const string FOO = 'x';
    protected const int|string BAR = 42;
    private const array LIST = [1, 2];
}
===print===
class C
{
    public const string FOO = 'x';

    protected const int|string BAR = 42;

    private const array LIST = [1, 2];
}
