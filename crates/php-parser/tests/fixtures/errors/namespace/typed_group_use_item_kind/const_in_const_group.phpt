===source===
<?php
use const Foo\{A, const B};
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
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "A"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 21,
                  "end": 22
                }
              },
              "alias": null,
              "span": {
                "start": 21,
                "end": 22
              }
            },
            {
              "name": {
                "parts": [
                  "Foo",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 30,
                  "end": 31
                }
              },
              "alias": null,
              "kind": "Const",
              "span": {
                "start": 24,
                "end": 31
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
