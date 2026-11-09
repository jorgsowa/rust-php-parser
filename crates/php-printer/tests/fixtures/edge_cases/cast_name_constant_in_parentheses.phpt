===source===
<?php
foo(
int
);
$o->m(
Float
);
C::m(
string
);
new C(
bool
);
if (
int
) {}
while (
binary
) {}
$x = match (
void
) { default => 1 };
$y = (
DOUBLE
);
echo empty(
integer
);
#[A(
real
)]
function f() {}
$z = foo(
$int
) + myint(
x
) + foo(\int) + foo(int: 1);
===print===
<?php
foo(int
);
$o->m(Float
);
C::m(string
);
new C(bool
);
if (int
) {}
while (binary
) {}
$x = match (void
) {
    default => 1,
};
$y = (DOUBLE
);
echo empty(integer
);

#[A(real
)]
function f()
{}

$z = foo($int) + myint(x) + foo(\int) + foo(int: 1);
