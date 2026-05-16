===source===
<?php
// PHP: (!($a instanceof Foo)) && (!($b instanceof Bar)).
!$a instanceof Foo && !$b instanceof Bar;
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
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 65,
                              "end": 67
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Identifier": "Foo"
                            },
                            "span": {
                              "start": 79,
                              "end": 82
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 65,
                        "end": 82
                      }
                    }
                  }
                },
                "span": {
                  "start": 64,
                  "end": 82
                }
              },
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 87,
                              "end": 89
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Identifier": "Bar"
                            },
                            "span": {
                              "start": 101,
                              "end": 104
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 87,
                        "end": 104
                      }
                    }
                  }
                },
                "span": {
                  "start": 86,
                  "end": 104
                }
              }
            }
          },
          "span": {
            "start": 64,
            "end": 104
          }
        }
      },
      "span": {
        "start": 64,
        "end": 105
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105
  }
}
