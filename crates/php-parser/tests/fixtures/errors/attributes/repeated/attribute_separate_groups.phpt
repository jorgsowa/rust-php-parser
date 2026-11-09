===source===
<?php
#[Attribute] #[Attribute] class A {}
===errors >=8.0===
Attribute "Attribute" must not be repeated
===php_error >=8.0===
PHP Fatal error:  Attribute "Attribute" must not be repeated in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 42
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
              "start": 38,
              "end": 39
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
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 21,
                  "end": 30
                }
              },
              "args": [],
              "span": {
                "start": 21,
                "end": 30
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
