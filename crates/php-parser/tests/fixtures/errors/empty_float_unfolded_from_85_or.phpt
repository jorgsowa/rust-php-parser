===source===
<?php
empty(0.0) || isset(1 + 1);
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
                      "Float": 0.0
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
              "op": "BooleanOr",
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
                              "start": 26,
                              "end": 27
                            }
                          },
                          "op": "Add",
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
                        "start": 26,
                        "end": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 20,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
