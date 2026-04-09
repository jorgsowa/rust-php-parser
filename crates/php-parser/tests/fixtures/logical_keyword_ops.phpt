===source===
<?php $a and $b or $c xor $d;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 8,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "op": "LogicalAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 13,
                        "end": 15,
                        "start_line": 1,
                        "start_col": 13
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
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 19,
                        "end": 21,
                        "start_line": 1,
                        "start_col": 19
                      }
                    },
                    "op": "LogicalXor",
                    "right": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 26,
                        "end": 28,
                        "start_line": 1,
                        "start_col": 26
                      }
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 28,
                  "start_line": 1,
                  "start_col": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29,
    "start_line": 1,
    "start_col": 0
  }
}
