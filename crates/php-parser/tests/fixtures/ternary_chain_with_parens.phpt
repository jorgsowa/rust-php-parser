===config===
parse_version=8.0
===source===
<?php $x = (true ? 1 : 2) ? 3 : 4;
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
                        "Parenthesized": {
                          "kind": {
                            "Ternary": {
                              "condition": {
                                "kind": {
                                  "Bool": true
                                },
                                "span": {
                                  "start": 12,
                                  "end": 16
                                }
                              },
                              "then_expr": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 19,
                                  "end": 20
                                }
                              },
                              "else_expr": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 23,
                                  "end": 24
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 12,
                            "end": 24
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 25
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 28,
                        "end": 29
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 32,
                        "end": 33
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
