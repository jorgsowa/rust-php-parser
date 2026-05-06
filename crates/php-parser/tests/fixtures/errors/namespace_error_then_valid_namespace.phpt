===source===
<?php namespace ; namespace Foo\Bar;
===errors===
expected identifier, found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [],
            "kind": "Error",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "Foo",
              "Bar"
            ],
            "kind": "Qualified",
            "span": {
              "start": 28,
              "end": 35
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 18,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "{" in Standard input code on line 1
