===source===
<?php
#[Deprecated] class C {}
===errors 8.4===
Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant)
===errors >=8.5===
Cannot apply #[\Deprecated] to class C
===php_error 8.4===
PHP Fatal error:  Attribute "Deprecated" cannot target class (allowed targets: function, method, class constant) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Deprecated] to class C in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 30
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 26,
              "end": 27
            }
          },
          "modifiers": {
            "is_abstract": false,
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
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
