===source===
<?php class C {
    use A, B {
        A::foo insteadof B;
        B::foo as barFromB;
        B::bar as protected;
        B::baz as protected renamedBaz;
    }
}
===print===
class C
{
    use A, B {
        A::foo insteadof B;
        B::foo as barFromB;
        B::bar as protected;
        B::baz as protected renamedBaz;
    }
}
