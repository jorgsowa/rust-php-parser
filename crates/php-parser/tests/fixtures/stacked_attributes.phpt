===source===
<?php #[A] #[B] class Foo {}
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
                  "end": 9,
                  "start_line": 1,
                  "start_col": 8
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 9,
                "start_line": 1,
                "start_col": 8
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
                  "end": 14,
                  "start_line": 1,
                  "start_col": 13
                }
              },
              "args": [],
              "span": {
                "start": 13,
                "end": 14,
                "start_line": 1,
                "start_col": 13
              }
            }
          ]
        }
      },
      "span": {
        "start": 16,
        "end": 28,
        "start_line": 1,
        "start_col": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}
