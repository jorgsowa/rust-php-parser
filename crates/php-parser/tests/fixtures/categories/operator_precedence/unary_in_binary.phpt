===source===
<?php !$a && !$b || !$c;
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
                        "UnaryPrefix": {
                          "op": "BooleanNot",
                          "operand": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 7,
                              "end": 9,
                              "start_line": 1,
                              "start_col": 7
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 9,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "BooleanNot",
                          "operand": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 14,
                              "end": 16,
                              "start_line": 1,
                              "start_col": 14
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 16,
                        "start_line": 1,
                        "start_col": 13
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
              },
              "op": "BooleanOr",
              "right": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 21,
                        "end": 23,
                        "start_line": 1,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 1,
            "start_col": 6
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
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
