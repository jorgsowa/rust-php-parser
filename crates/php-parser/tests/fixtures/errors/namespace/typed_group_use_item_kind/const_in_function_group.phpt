===source===
<?php
use function Foo\{a, const C};
===errors===
expected name, found 'const'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'const' (T_CONST), expecting '}' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "const", expecting "}" in Standard input code on line 2
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
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 33,
                  "end": 34
                }
              },
              "alias": null,
              "kind": "Const",
              "span": {
                "start": 27,
                "end": 34
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
