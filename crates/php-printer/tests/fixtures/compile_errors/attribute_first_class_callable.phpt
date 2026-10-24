===config===
php_error=Cannot create Closure as attribute argument
===source===
<?php #[Foo(...)] function f() {}
===print===
<?php
#[Foo(...)]
function f()
{}
