===source===
<?php
#[Override] class A {}
===errors 8.3-8.4===
Attribute "Override" cannot target class (allowed targets: method)
===errors 8.5===
Attribute "Override" cannot target class (allowed targets: method, property)
===errors >=8.6===
Attribute "Override" cannot target class (allowed targets: method, property, class constant)
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target class (allowed targets: method) in Standard input code on line 2
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target class (allowed targets: method, property) in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Attribute "Override" cannot target class (allowed targets: method, property, class constant) in Standard input code on line 2
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
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 24,
              "end": 25
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
                  "Override"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 16
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 16
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
