===source===
<?php
start:
if ($count++ < 3) {
    goto start;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Label": "start"
      },
      "span": {
        "start": 6,
        "end": 13,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "UnaryPostfix": {
                      "operand": {
                        "kind": {
                          "Variable": "count"
                        },
                        "span": {
                          "start": 17,
                          "end": 23,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "op": "PostIncrement"
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 25,
                    "start_line": 3,
                    "start_col": 4
                  }
                },
                "op": "Less",
                "right": {
                  "kind": {
                    "Int": 3
                  },
                  "span": {
                    "start": 28,
                    "end": 29,
                    "start_line": 3,
                    "start_col": 15
                  }
                }
              }
            },
            "span": {
              "start": 17,
              "end": 29,
              "start_line": 3,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Goto": "start"
                  },
                  "span": {
                    "start": 37,
                    "end": 49,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 31,
              "end": 50,
              "start_line": 3,
              "start_col": 18
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 13,
        "end": 50,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}
