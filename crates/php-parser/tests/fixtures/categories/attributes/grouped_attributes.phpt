===source===
<?php #[A, B] class Foo {}
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
              "start": 20,
              "end": 23
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
            }
          ]
        }
      },
      "span": {
        "start": 14,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
