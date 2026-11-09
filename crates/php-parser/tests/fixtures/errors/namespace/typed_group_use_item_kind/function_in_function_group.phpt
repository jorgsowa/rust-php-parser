===source===
<?php
use function Foo\{a, function b};
===errors===
expected name, found 'function'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'function' (T_FUNCTION), expecting '}' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "function", expecting "}" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "a"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 24,
                  "end": 25
                }
              },
              "alias": null,
              "span": {
                "start": 24,
                "end": 25
              }
            },
            {
              "name": {
                "parts": [
                  "Foo",
                  "b"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 36,
                  "end": 37
                }
              },
              "alias": null,
              "kind": "Function",
              "span": {
                "start": 27,
                "end": 37
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
