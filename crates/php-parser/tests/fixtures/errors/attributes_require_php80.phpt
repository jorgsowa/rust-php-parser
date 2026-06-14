===config===
min_php=7.4
===source===
<?php
#[Attr]
class C {}
===errors===
'attributes' requires PHP 8.0 or higher (targeting PHP 7.4)
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "C",
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
