===source===
<?php
echo 1;
echo 2;
namespace A;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 11,
              "end": 12,
              "start_line": 2,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 14,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 2
            },
            "span": {
              "start": 19,
              "end": 20,
              "start_line": 3,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 14,
        "end": 22,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 32,
              "end": 33,
              "start_line": 4,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 22,
        "end": 34,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
