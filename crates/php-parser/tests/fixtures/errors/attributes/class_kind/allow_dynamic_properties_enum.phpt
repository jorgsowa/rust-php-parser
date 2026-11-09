===source===
<?php
#[AllowDynamicProperties] enum F {}
===errors 8.0===
'enums' requires PHP 8.1 or higher
===errors 8.4===
Cannot apply #[AllowDynamicProperties] to enum F
===errors >=8.5===
Cannot apply #[\AllowDynamicProperties] to enum F
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 2
===php_error 8.4===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to enum F in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\AllowDynamicProperties] to enum F in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 41
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "F",
            "span": {
              "start": 37,
              "end": 38
            }
          },
          "scalar_type": null,
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
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
