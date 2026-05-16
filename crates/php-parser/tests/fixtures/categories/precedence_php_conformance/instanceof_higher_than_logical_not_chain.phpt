===description===
PHP: (!($a instanceof Foo)) && (!($b instanceof Bar)).
===source===
<?php
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
                              "start": 7,
                              "end": 9
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Identifier": "Foo"
                            },
                            "span": {
                              "start": 21,
                              "end": 24
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 24
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
                              "start": 29,
                              "end": 31
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Identifier": "Bar"
                            },
                            "span": {
                              "start": 43,
                              "end": 46
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 46
                      }
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 46
          }
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
