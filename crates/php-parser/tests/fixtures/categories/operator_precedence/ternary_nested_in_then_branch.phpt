===source===
<?php
$a = $x ? $y ? 1 : 2 : 3;
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
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 16,
                              "end": 18
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 21,
                              "end": 22
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 25,
                              "end": 26
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 26
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
