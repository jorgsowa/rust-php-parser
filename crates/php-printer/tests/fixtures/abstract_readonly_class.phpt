===source===
<?php
abstract readonly class A {}
readonly abstract class B {}
#[X]
abstract readonly class C {}
#[X]
readonly abstract class D {}
final readonly class E {}
===print===
<?php
abstract readonly class A
{}

abstract readonly class B
{}

#[X]
abstract readonly class C
{}

#[X]
abstract readonly class D
{}

final readonly class E
{}
