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
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
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
                                  "end": 16,
                                  "start_line": 1,
                                  "start_col": 12
                                }
                              },
                              "then_expr": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 19,
                                  "end": 20,
                                  "start_line": 1,
                                  "start_col": 19
                                }
                              },
                              "else_expr": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 23,
                                  "end": 24,
                                  "start_line": 1,
                                  "start_col": 23
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 12,
                            "end": 24,
                            "start_line": 1,
                            "start_col": 12
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 26,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 28,
                        "end": 29,
                        "start_line": 1,
                        "start_col": 28
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 32,
                        "end": 33,
                        "start_line": 1,
                        "start_col": 32
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
