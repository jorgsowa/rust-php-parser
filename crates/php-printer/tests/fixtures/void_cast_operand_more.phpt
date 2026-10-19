===source===
<?php
(void) $a ?? f();
(void) $a = f() + 1;
for ((void) f() + 1; ;) {}
if ($a) (void) f() . "x";
===print===
<?php
(void)($a ?? f());
(void)($a = f() + 1);
for ((void)(f() + 1); ; ) {}
if ($a) {
    (void)(f() . 'x');
}
