===source===
<?php #[MyAttr] const VERSION = '8.5';
===errors 8.0-8.4===
'attributes on constants' requires PHP 8.5 or higher
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 1
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 38
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "VERSION",
              "span": {
                "start": 22,
                "end": 29
              }
            },
            "value": {
              "kind": {
                "String": "8.5"
              },
              "span": {
                "start": 32,
                "end": 37
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "MyAttr"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 8,
                    "end": 14
                  }
                },
                "args": [],
                "span": {
                  "start": 8,
                  "end": 14
                }
              }
            ],
            "span": {
              "start": 22,
              "end": 37
            }
          }
        ]
      },
      "span": {
        "start": 16,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
