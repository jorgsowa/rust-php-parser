===source===
<?php
$a = 1 + * 2;
$b = 3;
===errors===
expected expression
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 11,
                        "end": 12,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": "Error",
                            "span": {
                              "start": 15,
                              "end": 16,
                              "start_line": 2,
                              "start_col": 9
                            }
                          },
                          "op": "Mul",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 17,
                              "end": 18,
                              "start_line": 2,
                              "start_col": 11
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 18,
                        "start_line": 2,
                        "start_col": 9
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 18,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 20,
                  "end": 22,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 25,
                  "end": 26,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 26,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 20,
        "end": 27,
        "start_line": 3,
        "start_col": 0
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
