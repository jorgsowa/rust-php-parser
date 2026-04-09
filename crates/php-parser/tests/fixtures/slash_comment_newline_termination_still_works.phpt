===source===
<?php // comment
$x = 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 17,
                  "end": 19,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 22,
                  "end": 23,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 17,
            "end": 23,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 17,
        "end": 24,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
