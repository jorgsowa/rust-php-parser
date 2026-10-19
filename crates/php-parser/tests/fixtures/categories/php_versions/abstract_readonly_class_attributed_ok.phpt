===config===
min_php=8.2
max_php=8.2
===source===
<?php
#[A]
abstract readonly class Foo {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 35,
              "end": 38
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 9
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 29,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
