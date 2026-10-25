===source===
<?php
!print 1 && isset(1+1);
===errors===
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===php_error===
PHP Fatal error:  Cannot use isset() on the result of an expression (you can use "null !== expression" instead) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BooleanNot",
              "operand": {
                "kind": {
                  "Print": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 13,
                            "end": 14
                          }
                        },
                        "op": "BooleanAnd",
                        "right": {
                          "kind": {
                            "Isset": [
                              {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 24,
                                        "end": 25
                                      }
                                    },
                                    "op": "Add",
                                    "right": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 26,
                                        "end": 27
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 24,
                                  "end": 27
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 18,
                            "end": 28
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 28
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
