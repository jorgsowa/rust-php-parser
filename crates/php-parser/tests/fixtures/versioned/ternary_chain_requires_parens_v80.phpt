===config===
parse_version=8.0
===source===
<?php $x = true ? 1 : 2 ? 3 : 4;
===errors===
Unparenthesized `a ? b : c ? d : e` is not supported. Use parentheses to make the order explicit.
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
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Bool": true
                            },
                            "span": {
                              "start": 11,
                              "end": 15
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 18,
                              "end": 19
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 22,
                              "end": 23
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 23
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 26,
                        "end": 27
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 30,
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
