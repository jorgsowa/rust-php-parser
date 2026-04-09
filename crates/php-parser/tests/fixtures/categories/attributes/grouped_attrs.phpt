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
                  "start": 11,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 11
                }
              },
              "args": [],
              "span": {
                "start": 11,
                "end": 12,
                "start_line": 1,
                "start_col": 11
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
                  "end": 15,
                  "start_line": 1,
                  "start_col": 14
                }
              },
              "args": [],
              "span": {
                "start": 14,
                "end": 15,
                "start_line": 1,
                "start_col": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 17,
        "end": 29,
        "start_line": 1,
        "start_col": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29,
    "start_line": 1,
    "start_col": 0
  }
}
