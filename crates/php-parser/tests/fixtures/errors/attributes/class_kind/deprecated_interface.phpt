===source===
<?php
#[Deprecated] interface K {}
===errors 8.4===
Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant)
===errors >=8.5===
Cannot apply #[\Deprecated] to interface K
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Deprecated] to interface K in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 34
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "K",
            "span": {
              "start": 30,
              "end": 31
            }
          },
          "extends": [],
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
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
