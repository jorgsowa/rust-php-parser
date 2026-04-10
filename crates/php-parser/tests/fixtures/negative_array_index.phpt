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
                  "end": 10
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
                        "end": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
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
                        "end": 20
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
                              "end": 23
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 24
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "last"
                },
                "span": {
                  "start": 27,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 33
          }
        }
      },
      "span": {
        "start": 16,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
