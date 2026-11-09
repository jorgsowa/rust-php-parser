===source===
<?php
#[Deprecated] enum G {}
===errors 8.0===
'enums' requires PHP 8.1 or higher
===errors 8.4===
Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant)
===errors >=8.5===
Cannot apply #[\Deprecated] to enum G
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 2
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Deprecated] to enum G in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 29
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "G",
            "span": {
              "start": 25,
              "end": 26
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 18
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 18
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
