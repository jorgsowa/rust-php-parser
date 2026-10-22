===config===
php_error=Cannot mix bracketed namespace declarations with unbracketed namespace declarations
===source===
<?php namespace A; function f() {} namespace B { function g() {} }
===print===
<?php
namespace A;

function f()
{}

namespace B {
    function g()
    {}
}
