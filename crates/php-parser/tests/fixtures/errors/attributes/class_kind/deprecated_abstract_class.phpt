===source===
<?php
#[Deprecated] abstract class D {}
===errors 8.4===
Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant)
===errors >=8.5===
Cannot apply #[\Deprecated] to class D
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Deprecated] to class D in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 39
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 35,
              "end": 36
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
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
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
