===source===
<?php function f(#[FromQuery] int $page) {}
===print===
<?php
function f(#[FromQuery] int $page)
{}
