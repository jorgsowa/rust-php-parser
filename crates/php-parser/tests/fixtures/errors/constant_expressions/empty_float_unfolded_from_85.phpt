===source===
<?php
empty(1.5) and isset(1 + 1);
===errors >=8.5===
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===php_error >=8.5===
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
                  "Empty": {
                    "kind": {
                      "Float": 1.5
                    },
                    "span": {
                      "start": 12,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "op": "LogicalAnd",
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
                              "start": 27,
                              "end": 28
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 31,
                              "end": 32
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 32
                      }
                    }
                  ]
                },
                "span": {
                  "start": 21,
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
