===source===
<?php
#[\Attribute, ATTRIBUTE] class E {}
===errors >=8.0===
Attribute "ATTRIBUTE" must not be repeated
===php_error >=8.0===
PHP Fatal error:  Attribute "Attribute" must not be repeated in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 41
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "E",
            "span": {
              "start": 37,
              "end": 38
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
                "kind": "FullyQualified",
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
            },
            {
              "name": {
                "parts": [
                  "ATTRIBUTE"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 29
                }
              },
              "args": [],
              "span": {
                "start": 20,
                "end": 29
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
