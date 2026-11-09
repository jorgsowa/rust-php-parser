===source===
<?php
!1.5 and isset(1+1);
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
                  "UnaryPrefix": {
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "Float": 1.5
                      },
                      "span": {
                        "start": 7,
                        "end": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
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
                              "start": 21,
                              "end": 22
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 23,
                              "end": 24
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 24
                      }
                    }
                  ]
                },
                "span": {
                  "start": 15,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
