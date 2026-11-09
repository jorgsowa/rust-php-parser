===source===
<?php
#[Override] const K = 1;
===errors 8.0-8.4===
'attributes on constants' requires PHP 8.5 or higher
===errors 8.5===
Attribute "Override" cannot target constant (allowed targets: method, property)
===errors >=8.6===
Attribute "Override" cannot target constant (allowed targets: method, property, class constant)
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 2
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target constant (allowed targets: method, property) in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Attribute "Override" cannot target constant (allowed targets: method, property, class constant) in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 30
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
              "name": "K",
              "span": {
                "start": 24,
                "end": 25
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 28,
                "end": 29
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "Override"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 8,
                    "end": 16
                  }
                },
                "args": [],
                "span": {
                  "start": 8,
                  "end": 16
                }
              }
            ],
            "span": {
              "start": 24,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
