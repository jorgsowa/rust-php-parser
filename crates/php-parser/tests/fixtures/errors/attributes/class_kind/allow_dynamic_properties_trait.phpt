===source===
<?php
#[AllowDynamicProperties] trait U {}
===errors 8.2-8.3===
Cannot apply #[AllowDynamicProperties] to trait
===errors 8.4===
Cannot apply #[AllowDynamicProperties] to trait U
===errors >=8.5===
Cannot apply #[\AllowDynamicProperties] to trait U
===php_error 8.2-8.3===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to trait in Standard input code on line 2
===php_error 8.4===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to trait U in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\AllowDynamicProperties] to trait U in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 42
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "U",
            "span": {
              "start": 38,
              "end": 39
            }
          },
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
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
