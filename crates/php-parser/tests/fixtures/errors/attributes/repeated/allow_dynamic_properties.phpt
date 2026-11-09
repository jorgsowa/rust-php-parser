===source===
<?php
#[AllowDynamicProperties, AllowDynamicProperties] class C {}
===errors >=8.2===
Attribute "AllowDynamicProperties" must not be repeated
===php_error >=8.2===
PHP Fatal error:  Attribute "AllowDynamicProperties" must not be repeated in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [],
  "span": {
    "start": 0,
    "end": 66
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
              "start": 62,
              "end": 63
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
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 30
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 30
              }
            },
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 32,
                  "end": 54
                }
              },
              "args": [],
              "span": {
                "start": 32,
                "end": 54
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 66
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66
  }
}
