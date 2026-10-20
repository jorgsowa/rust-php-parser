===source===
<?php
$a = <<<1X
a
1X;
===errors >=8.5===
expected expression
expected expression
expected ';' after expression
expected ';' after expression
expected ';' after expression
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected token "<<" in Standard input code on line 2
===ast >=8.5===
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
                        "Binary": {
                          "left": {
                            "kind": "Error",
                            "span": {
                              "start": 11,
                              "end": 13
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": "Error",
                            "span": {
                              "start": 13,
                              "end": 14
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 14
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 14,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "X"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 15,
                "end": 16
              }
            }
          },
          "span": {
            "start": 15,
            "end": 16
          }
        }
      },
      "span": {
        "start": 15,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "a"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 17,
                "end": 18
              }
            }
          },
          "span": {
            "start": 17,
            "end": 18
          }
        }
      },
      "span": {
        "start": 17,
        "end": 18
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 1
          },
          "span": {
            "start": 19,
            "end": 20
          }
        }
      },
      "span": {
        "start": 19,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "X"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 20,
                "end": 21
              }
            }
          },
          "span": {
            "start": 20,
            "end": 21
          }
        }
      },
      "span": {
        "start": 20,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
