===source===
<?php for ($i = 0, $j = 10; $i < $j; $i++, $j--) { echo $i; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 11,
                      "end": 13,
                      "start_line": 1,
                      "start_col": 11
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 16,
                      "end": 17,
                      "start_line": 1,
                      "start_col": 16
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 17,
                "start_line": 1,
                "start_col": 11
              }
            },
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "j"
                    },
                    "span": {
                      "start": 19,
                      "end": 21,
                      "start_line": 1,
                      "start_col": 19
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 24,
                      "end": 26,
                      "start_line": 1,
                      "start_col": 24
                    }
                  }
                }
              },
              "span": {
                "start": 19,
                "end": 26,
                "start_line": 1,
                "start_col": 19
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 28,
                      "end": 30,
                      "start_line": 1,
                      "start_col": 28
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Variable": "j"
                    },
                    "span": {
                      "start": 33,
                      "end": 35,
                      "start_line": 1,
                      "start_col": 33
                    }
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 35,
                "start_line": 1,
                "start_col": 28
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 37,
                      "end": 39,
                      "start_line": 1,
                      "start_col": 37
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 37,
                "end": 41,
                "start_line": 1,
                "start_col": 37
              }
            },
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "j"
                    },
                    "span": {
                      "start": 43,
                      "end": 45,
                      "start_line": 1,
                      "start_col": 43
                    }
                  },
                  "op": "PostDecrement"
                }
              },
              "span": {
                "start": 43,
                "end": 47,
                "start_line": 1,
                "start_col": 43
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "i"
                        },
                        "span": {
                          "start": 56,
                          "end": 58,
                          "start_line": 1,
                          "start_col": 56
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 51,
                    "end": 60,
                    "start_line": 1,
                    "start_col": 51
                  }
                }
              ]
            },
            "span": {
              "start": 49,
              "end": 61,
              "start_line": 1,
              "start_col": 49
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 61,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61,
    "start_line": 1,
    "start_col": 0
  }
}
