===source===
<?php ($x + $y;
===errors===
unclosed '')'' opened at 1:6
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Parenthesized": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 7,
                      "end": 9,
                      "start_line": 1,
                      "start_col": 7
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "Variable": "y"
                    },
                    "span": {
                      "start": 12,
                      "end": 14,
                      "start_line": 1,
                      "start_col": 12
                    }
                  }
                }
              },
              "span": {
                "start": 7,
                "end": 14,
                "start_line": 1,
                "start_col": 7
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15,
    "start_line": 1,
    "start_col": 0
  }
}
