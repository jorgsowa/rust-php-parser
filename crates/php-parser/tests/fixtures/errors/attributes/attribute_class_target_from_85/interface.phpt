===source===
<?php
#[Attribute] interface I {}
===errors >=8.5===
Cannot apply #[\Attribute] to interface I
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Attribute] to interface I in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 33
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 29,
              "end": 30
            }
          },
          "extends": [],
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
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
