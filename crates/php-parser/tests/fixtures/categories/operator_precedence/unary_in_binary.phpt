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
                              "end": 9
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 9
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
                              "end": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
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
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
