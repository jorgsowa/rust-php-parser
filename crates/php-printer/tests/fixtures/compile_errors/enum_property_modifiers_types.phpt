===config===
php_error=Enum E cannot include properties
===source===
<?php enum E { #[Attr] private static ?int $a; protected readonly A|B $b; final public (A&B)|null $c = null; public \Foo\Bar $d; const X = 1; }
===print===
<?php
enum E
{
    #[Attr]
    private static ?int $a;

    protected readonly A|B $b;

    final public (A&B)|null $c = null;

    public \Foo\Bar $d;

    const X = 1;
}
