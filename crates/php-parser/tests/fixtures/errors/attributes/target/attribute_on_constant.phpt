===source===
<?php
#[Attribute] const L = 1;
===errors 8.0-8.4===
'attributes on constants' requires PHP 8.5 or higher
===errors >=8.5===
Attribute "Attribute" cannot target constant (allowed targets: class)
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Attribute "Attribute" cannot target constant (allowed targets: class) in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 31
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
              "name": "L",
              "span": {
                "start": 25,
                "end": 26
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 29,
                "end": 30
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "Attribute"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 8,
                    "end": 17
                  }
                },
                "args": [],
                "span": {
                  "start": 8,
                  "end": 17
                }
              }
            ],
            "span": {
              "start": 25,
              "end": 30
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
