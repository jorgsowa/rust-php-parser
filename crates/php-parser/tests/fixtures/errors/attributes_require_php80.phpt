===source===
<?php
#[Attr]
class C {}
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
===ast >=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 20,
              "end": 21
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
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 12
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 12
              }
            }
          ]
        }
      },
      "span": {
        "start": 14,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
