===source===
<?php $x++; $y--;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
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
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 6,
            "end": 10,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 12,
                  "end": 14,
                  "start_line": 1,
                  "start_col": 12
                }
              },
              "op": "PostDecrement"
            }
          },
          "span": {
            "start": 12,
            "end": 16,
            "start_line": 1,
            "start_col": 12
          }
        }
      },
      "span": {
        "start": 12,
        "end": 17,
        "start_line": 1,
        "start_col": 12
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
