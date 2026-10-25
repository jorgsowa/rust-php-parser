===source===
<?php
class A { use T { f as public final g; } }
===print===
<?php
syntax error;
class A
{
    use T {
        f as public final;
    }
}
