===source===
<?php
$a = 1 + * 2;
$b = 3;
===errors===
expected expression
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": "Error",
                            "span": {
                              "start": 15,
                              "end": 16
                            }
                          },
                          "op": "Mul",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
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
                  "start": 20,
                  "end": 22
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 25,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 26
          }
        }
      },
      "span": {
        "start": 20,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "*" in Standard input code on line 2
