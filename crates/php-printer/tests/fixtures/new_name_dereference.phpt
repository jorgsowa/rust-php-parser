===source===
<?php new Foo()->bar(); new \Foo\Bar()::C; (new namespace\Foo)->baz; new Foo::$cls;
===print===
<?php
new Foo()->bar();
new \Foo\Bar()::C;
(new namespace\Foo())->baz;
new Foo::$cls();
