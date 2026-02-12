<?php

// Single attribute on function
#[Pure]
function add(int $a, int $b): int {
    return $a + $b;
}

// Attribute with arguments
#[Route("/api/users", methods: ["GET", "POST"])]
function listUsers() {}

// Multiple grouped attributes
#[A, B]
class Foo {}

// Stacked attributes
#[Attribute1]
#[Attribute2]
class Bar {}

// Attributes on class members
class User {
    #[Column("name")]
    public string $name;

    #[Id]
    #[GeneratedValue]
    private int $id;

    #[Deprecated("Use getName() instead")]
    public function name(): string {
        return $this->name;
    }
}

// Attribute on parameter
function greet(#[FromQuery] string $name) {}

// Hash comment still works
# This is a comment
$x = 1;

// Attribute on enum
#[EnumAttr]
enum Color {
    #[CaseAttr]
    case Red;
    case Blue;
}
