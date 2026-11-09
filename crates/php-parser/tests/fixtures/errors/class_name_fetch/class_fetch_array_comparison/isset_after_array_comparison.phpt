===source===
<?php
[] == [] && isset(1 + 1);
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
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
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
                              "start": 28,
                              "end": 29
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 18,
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
