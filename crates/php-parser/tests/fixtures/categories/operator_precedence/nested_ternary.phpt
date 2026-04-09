===source===
<?php $a ? $b : ($c ? $d : $e);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
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
              "then_expr": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 11,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 11
                }
              },
              "else_expr": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Ternary": {
                        "condition": {
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
                        "then_expr": {
                          "kind": {
                            "Variable": "d"
                          },
                          "span": {
                            "start": 22,
                            "end": 24,
                            "start_line": 1,
                            "start_col": 22
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "e"
                          },
                          "span": {
                            "start": 27,
                            "end": 29,
                            "start_line": 1,
                            "start_col": 27
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 29,
                      "start_line": 1,
                      "start_col": 17
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 30,
                  "start_line": 1,
                  "start_col": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31,
    "start_line": 1,
    "start_col": 0
  }
}
