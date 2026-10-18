===source===
<?php
$a = [
    'x' => [
        // inside empty
    ],
    'y' => [1, /* block */ 2],
];
$b = [
    // first
    1,
];
f(
    // only comment
);
$c->d(
    1, // one
    2
);
$e = new Foo(
    // leading
    $a,
);
===print===
<?php
$a = [
    'x' => [
        // inside empty
    ],
    'y' => [1, /* block */ 2],
];
$b = [
    // first
    1,
];
f(
    // only comment
);
$c->d(
    1, // one
    2
);
$e = new Foo(
    // leading
    $a
);
