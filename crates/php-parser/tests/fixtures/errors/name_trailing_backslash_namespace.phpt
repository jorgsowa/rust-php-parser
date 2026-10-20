===source===
<?php
namespace Foo\;
===errors >=8.5===
expected identifier, found ';'
===php_error===
PHP Parse error:  syntax error, unexpected token "\", expecting "{" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
