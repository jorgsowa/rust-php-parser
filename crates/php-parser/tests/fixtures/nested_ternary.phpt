===source===
<?php $x > 0 ? 'pos' : ($x < 0 ? 'neg' : 'zero');
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
                  "Binary": {
                    "left": {
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
                    "op": "Greater",
                    "right": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 11,
                        "end": 12,
                        "start_line": 1,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "then_expr": {
                "kind": {
                  "String": "pos"
                },
                "span": {
                  "start": 15,
                  "end": 20,
                  "start_line": 1,
                  "start_col": 15
                }
              },
              "else_expr": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 24,
                                  "end": 26,
                                  "start_line": 1,
                                  "start_col": 24
                                }
                              },
                              "op": "Less",
                              "right": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 29,
                                  "end": 30,
                                  "start_line": 1,
                                  "start_col": 29
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 24,
                            "end": 30,
                            "start_line": 1,
                            "start_col": 24
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "String": "neg"
                          },
                          "span": {
                            "start": 33,
                            "end": 38,
                            "start_line": 1,
                            "start_col": 33
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "String": "zero"
                          },
                          "span": {
                            "start": 41,
                            "end": 47,
                            "start_line": 1,
                            "start_col": 41
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 47,
                      "start_line": 1,
                      "start_col": 24
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 48,
                  "start_line": 1,
                  "start_col": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 48,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 49,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49,
    "start_line": 1,
    "start_col": 0
  }
}
