===source===
<?php 1 + 2 * 3;
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
                  "Int": 1
                },
                "span": {
                  "start": 6,
                  "end": 7,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 10,
                        "end": 11,
                        "start_line": 1,
                        "start_col": 10
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 14,
                        "end": 15,
                        "start_line": 1,
                        "start_col": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 15,
                  "start_line": 1,
                  "start_col": 10
                }
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
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 1,
        "start_col": 6
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
