===source===
<?php
use A\B\{C as D, function e as f, const G as H};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 17,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": "D",
              "span": {
                "start": 15,
                "end": 21,
                "start_line": 2,
                "start_col": 9
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "e"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 34,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": "f",
              "kind": "Function",
              "span": {
                "start": 23,
                "end": 38,
                "start_line": 2,
                "start_col": 17
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "G"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 48,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": "H",
              "kind": "Const",
              "span": {
                "start": 40,
                "end": 52,
                "start_line": 2,
                "start_col": 34
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 54,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54,
    "start_line": 1,
    "start_col": 0
  }
}
