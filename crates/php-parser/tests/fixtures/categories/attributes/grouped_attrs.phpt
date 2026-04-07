===source===
<?php #[A, B, C] class Foo {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
