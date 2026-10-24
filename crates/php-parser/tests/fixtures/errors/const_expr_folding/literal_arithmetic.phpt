===source===
<?php
const A = (2 * 3 - 6) ? 1 : $x;
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 17,
                                      "end": 18
                                    }
                                  },
                                  "op": "Mul",
                                  "right": {
                                    "kind": {
                                      "Int": 3
                                    },
                                    "span": {
                                      "start": 21,
                                      "end": 22
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 17,
                                "end": 22
                              }
                            },
                            "op": "Sub",
                            "right": {
                              "kind": {
                                "Int": 6
                              },
                              "span": {
                                "start": 25,
                                "end": 26
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 26
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 27
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 36
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 36
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
