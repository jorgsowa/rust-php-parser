===source===
<?php $a & $b && $c | $d;
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
                    "op": "BitwiseAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 11,
                        "end": 13,
                        "start_line": 1,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 17,
                        "end": 19,
                        "start_line": 1,
                        "start_col": 17
                      }
                    },
                    "op": "BitwiseOr",
                    "right": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 22,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25,
    "start_line": 1,
    "start_col": 0
  }
}
