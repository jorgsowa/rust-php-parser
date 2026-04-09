===source===
<?php $arr[-1]; $arr[-2] = 'last';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "index": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 12,
                        "end": 13,
                        "start_line": 1,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "arr"
                      },
                      "span": {
                        "start": 16,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 16
                      }
                    },
                    "index": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "Negate",
                          "operand": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 22,
                              "end": 23,
                              "start_line": 1,
                              "start_col": 22
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 23,
                        "start_line": 1,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 16
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "last"
                },
                "span": {
                  "start": 27,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 27
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 33,
            "start_line": 1,
            "start_col": 16
          }
        }
      },
      "span": {
        "start": 16,
        "end": 34,
        "start_line": 1,
        "start_col": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
