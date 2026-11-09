===source===
<?php
#[Attribute] enum E {}
===errors 8.0===
'enums' requires PHP 8.1 or higher
===errors >=8.5===
Cannot apply #[\Attribute] to enum E
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Attribute] to enum E in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 28
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 24,
              "end": 25
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
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
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
