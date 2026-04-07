===source===
<?php #[A] #[B] #[C] class Foo {}
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
                  "start": 13,
                  "end": 14
                }
              },
              "args": [],
              "span": {
                "start": 13,
                "end": 14
              }
            },
            {
              "name": {
                "parts": [
                  "C"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 18,
                  "end": 19
                }
              },
              "args": [],
              "span": {
                "start": 18,
                "end": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 21,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
