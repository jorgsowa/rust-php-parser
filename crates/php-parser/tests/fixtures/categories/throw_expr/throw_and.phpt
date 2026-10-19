===source===
<?php
$x = $c ?: throw $e and 1;
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
                  "Variable": "x"
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
                        "Variable": "c"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "Throw": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "e"
                                },
                                "span": {
                                  "start": 23,
                                  "end": 25
                                }
                              },
                              "op": "LogicalAnd",
                              "right": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 30,
                                  "end": 31
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 23,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 31
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
