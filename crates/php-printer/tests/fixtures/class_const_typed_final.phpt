===source===
<?php class C {
    final public const string FOO = 'x';
    protected const int|string BAR = 42;
    private const array LIST = [1, 2];
    final const PLAIN = 1;
}
===print===
class C
{
    final public const string FOO = 'x';

    protected const int|string BAR = 42;

    private const array LIST = [1, 2];

    final const PLAIN = 1;
}
