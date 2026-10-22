===source===
<?php #[A, B, C] class Foo {}
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 23,
              "end": 26
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
            },
            {
              "name": {
                "parts": [
                  "B"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 11,
                  "end": 12
                }
              },
              "args": [],
              "span": {
                "start": 11,
                "end": 12
              }
            },
            {
              "name": {
                "parts": [
                  "C"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 14,
                  "end": 15
                }
              },
              "args": [],
              "span": {
                "start": 14,
                "end": 15
              }
            }
          ]
        }
      },
      "span": {
        "start": 17,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
