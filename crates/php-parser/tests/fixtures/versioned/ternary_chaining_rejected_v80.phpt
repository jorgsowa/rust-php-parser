===config===
min_php=8.0
===source===
<?php
$b = $x ? 1 : $y ? 2 : 3;
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
                  "Variable": "b"
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
                              "Variable": "x"
                            },
                            "span": {
                              "start": 11,
                              "end": 13
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 16,
                              "end": 17
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 20,
                              "end": 22
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 22
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 25,
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
===php_error===
PHP Fatal error:  Unparenthesized `a ? b : c ? d : e` is not supported. Use either `(a ? b : c) ? d : e` or `a ? b : (c ? d : e)` in Standard input code on line 2
