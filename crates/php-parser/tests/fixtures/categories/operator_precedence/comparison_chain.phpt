===source===
<?php $a == $b && $b == $c;
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
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "Variable": "b"
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
                  "start": 6,
                  "end": 14,
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
                        "Variable": "b"
                      },
                      "span": {
                        "start": 18,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 18
                      }
                    },
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 24,
                        "end": 26,
                        "start_line": 1,
                        "start_col": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27,
    "start_line": 1,
    "start_col": 0
  }
}
