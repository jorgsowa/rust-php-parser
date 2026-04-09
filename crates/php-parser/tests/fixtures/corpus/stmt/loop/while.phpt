===source===
<?php

while ($a) {}

while ($a):
endwhile;
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 14,
              "end": 16,
              "start_line": 3,
              "start_col": 7
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 18,
              "end": 20,
              "start_line": 3,
              "start_col": 11
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 20,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 29,
              "end": 31,
              "start_line": 5,
              "start_col": 7
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 22,
              "end": 43,
              "start_line": 5,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 22,
        "end": 43,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}
