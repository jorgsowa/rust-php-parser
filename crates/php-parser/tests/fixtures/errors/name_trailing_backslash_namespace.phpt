===source===
<?php
namespace Foo\;
===errors===
expected identifier, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "\", expecting "{" in Standard input code on line 2
===ast===
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
