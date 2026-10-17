===source===
<?php
Foo::
===errors===
expected identifier, found end of file
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": "Error",
      "span": {
        "start": 6,
        "end": 11
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 11
  }
}
