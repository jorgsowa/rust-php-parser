===source===
<?php
// PHP: (new Foo()) instanceof Foo. new is the highest non-primary precedence.
STATUS: parser correct because new is parsed as atom (not via parse_expr_bp). Pinned.
new Foo() instanceof Foo;
