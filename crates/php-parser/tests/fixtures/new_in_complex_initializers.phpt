===source===
<?php
function foo(
    $a = new Foo(),
    $b = new Bar(1, 'test'),
    $c = new Baz(name: 'x'),
) {}
class Config {
    const DEFAULT = new Settings(debug: false);
}
