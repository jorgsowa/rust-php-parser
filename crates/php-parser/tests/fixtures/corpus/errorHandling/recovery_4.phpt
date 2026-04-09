===source===
<?php
abc;
1 + ;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "abc"
          },
          "span": {
            "start": 6,
            "end": 9,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 11,
                  "end": 12,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Add",
              "right": {
                "kind": "Error",
                "span": {
                  "start": 15,
                  "end": 16,
                  "start_line": 3,
                  "start_col": 4
                }
              }
            }
          },
          "span": {
            "start": 11,
            "end": 16,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 11,
        "end": 16,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16,
    "start_line": 1,
    "start_col": 0
  }
}
