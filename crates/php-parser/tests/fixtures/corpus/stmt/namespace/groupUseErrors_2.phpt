===source===
<?php
// Missing NS separator
use Foo {Bar, Baz};
===errors===
expected namespace separator before '{', found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 34,
                  "end": 42
                }
              },
              "alias": null,
              "span": {
                "start": 39,
                "end": 42
              }
            },
            {
              "name": {
                "parts": [
                  "Foo",
                  "Baz"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 34,
                  "end": 47
                }
              },
              "alias": null,
              "span": {
                "start": 44,
                "end": 47
              }
            }
          ]
        }
      },
      "span": {
        "start": 30,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
