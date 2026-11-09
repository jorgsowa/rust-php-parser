===source===
<?php
#[AllowDynamicProperties] interface J {}
===errors 8.2-8.3===
Cannot apply #[AllowDynamicProperties] to interface
===errors 8.4===
Cannot apply #[AllowDynamicProperties] to interface J
===errors >=8.5===
Cannot apply #[\AllowDynamicProperties] to interface J
===php_error 8.2-8.3===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to interface in Standard input code on line 2
===php_error 8.4===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to interface J in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\AllowDynamicProperties] to interface J in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 46
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "J",
            "span": {
              "start": 42,
              "end": 43
            }
          },
          "extends": [],
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
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
