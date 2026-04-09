===source===
<?php
use A\{B,};
use function A\{b,};
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
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 14,
                  "start_line": 2,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 13,
                "end": 14,
                "start_line": 2,
                "start_col": 7
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 18,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "b"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 31,
                  "end": 35,
                  "start_line": 3,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 34,
                "end": 35,
                "start_line": 3,
                "start_col": 16
              }
            }
          ]
        }
      },
      "span": {
        "start": 18,
        "end": 38,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
