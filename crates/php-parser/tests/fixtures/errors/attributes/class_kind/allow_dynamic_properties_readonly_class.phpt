===source===
<?php
#[AllowDynamicProperties] readonly class R {}
===errors 8.0-8.1===
'readonly class' requires PHP 8.2 or higher
===errors 8.2-8.4===
Cannot apply #[AllowDynamicProperties] to readonly class R
===errors >=8.5===
Cannot apply #[\AllowDynamicProperties] to readonly class R
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 2
===php_error 8.2-8.4===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to readonly class R in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\AllowDynamicProperties] to readonly class R in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 51
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "R",
            "span": {
              "start": 47,
              "end": 48
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 30
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 30
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
