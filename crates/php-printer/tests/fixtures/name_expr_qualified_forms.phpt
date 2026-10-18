===source===
<?php namespace App; \strlen($s); Foo\bar(); namespace\baz(); new \Foo\Bar; new namespace\Baz(); new Foo\Qux(); \Foo::C; namespace\Foo::m(); Foo\Bar::$p; $x instanceof \Foo; $x instanceof namespace\Foo; echo \PHP_EOL, namespace\LIMIT, Foo\LIMIT;
===print===
<?php
namespace App;
\strlen($s);
Foo\bar();
namespace\baz();
new \Foo\Bar();
new namespace\Baz();
new Foo\Qux();
\Foo::C;
namespace\Foo::m();
Foo\Bar::$p;
$x instanceof \Foo;
$x instanceof namespace\Foo;
echo \PHP_EOL, namespace\LIMIT, Foo\LIMIT;
