===source===
<?php
!1.5 and isset(1+1);
const A = !1.5 && $a;
===errors >=8.5===
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Constant expression contains invalid operations
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
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 33,
                "end": 34
              }
            },
            "value": {
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
                            "start": 38,
                            "end": 41
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 37,
                      "end": 41
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 45,
                      "end": 47
                    }
                  }
                }
              },
              "span": {
                "start": 37,
                "end": 47
              }
            },
            "attributes": [],
            "span": {
              "start": 33,
              "end": 47
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
