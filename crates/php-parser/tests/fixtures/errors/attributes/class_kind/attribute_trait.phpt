===source===
<?php
#[Attribute] trait T {}
===errors >=8.5===
Cannot apply #[\Attribute] to trait T
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Attribute] to trait T in Standard input code on line 2
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
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 25,
              "end": 26
            }
          },
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
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
