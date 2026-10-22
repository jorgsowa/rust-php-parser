===source===
<?php
$x = "${a[0] /* c */ + 1}";
===errors===
expected ']' to close the index in '${...}' string interpolation
===php_error===
PHP Parse error:  syntax error, unexpected token "+", expecting "}" in Standard input code on line 2
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "VariableVariable": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "ArrayAccess": {
                                      "array": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "a"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 14,
                                              "end": 15
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 14,
                                          "end": 15
                                        }
                                      },
                                      "index": {
                                        "kind": {
                                          "Int": 0
                                        },
                                        "span": {
                                          "start": 16,
                                          "end": 17
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 14,
                                    "end": 18
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 29,
                                    "end": 30
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 14,
                              "end": 30
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 31
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
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
