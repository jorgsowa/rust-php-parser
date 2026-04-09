===source===
<?php function f(#[FromQuery] int $page) {}
===print===
function f(#[FromQuery] int $page)
{}
