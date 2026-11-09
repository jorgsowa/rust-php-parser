===source===
<?php
#[Attribute, Attribute] class B {}
===errors >=8.0===
Attribute "Attribute" must not be repeated
===php_error >=8.0===
PHP Fatal error:  Attribute "Attribute" must not be repeated in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 40
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 36,
              "end": 37
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
                  "start": 19,
                  "end": 28
                }
              },
              "args": [],
              "span": {
                "start": 19,
                "end": 28
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
