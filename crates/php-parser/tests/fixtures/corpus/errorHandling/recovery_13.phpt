===source===
<?php
$foo instanceof
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": "Error",
                "span": {
                  "start": 21,
                  "end": 21,
                  "start_line": 0,
                  "start_col": 0
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21,
    "start_line": 1,
    "start_col": 0
  }
}
