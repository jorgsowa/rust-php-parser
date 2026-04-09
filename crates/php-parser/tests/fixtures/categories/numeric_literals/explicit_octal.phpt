===config===
min_php=8.1
===source===
<?php $x = 0o777;
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
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 511
                },
                "span": {
                  "start": 11,
                  "end": 16,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17,
    "start_line": 1,
    "start_col": 0
  }
}
