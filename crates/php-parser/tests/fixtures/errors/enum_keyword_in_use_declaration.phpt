===source===
<?php
use enum as E;
===errors >=8.1===
expected identifier, found 'enum'
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "enum" in Standard input code on line 2
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
                  "enum"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 14
                }
              },
              "alias": {
                "name": "E",
                "span": {
                  "start": 18,
                  "end": 19
                }
              },
              "span": {
                "start": 10,
                "end": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
