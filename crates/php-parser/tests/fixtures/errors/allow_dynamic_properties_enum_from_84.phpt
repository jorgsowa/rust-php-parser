===source===
<?php
#[AllowDynamicProperties]
enum E {}
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'enums' requires PHP 8.1 or higher
===errors 8.0===
'enums' requires PHP 8.1 or higher
===errors >=8.4===
Cannot apply #[\AllowDynamicProperties] to enum E
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 3
===php_error 8.4===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to enum E in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\AllowDynamicProperties] to enum E in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
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
        "start": 32,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
