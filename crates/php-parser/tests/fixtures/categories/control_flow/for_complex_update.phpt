===source===
<?php for ($i=0; $i<10; $i++, $j--, $k+=2) {}
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
                      "start": 14,
                      "end": 15,
                      "start_line": 1,
                      "start_col": 14
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 15,
                "start_line": 1,
                "start_col": 11
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
                      "start": 17,
                      "end": 19,
                      "start_line": 1,
                      "start_col": 17
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 20,
                      "end": 22,
                      "start_line": 1,
                      "start_col": 20
                    }
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 22,
                "start_line": 1,
                "start_col": 17
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
                      "start": 24,
                      "end": 26,
                      "start_line": 1,
                      "start_col": 24
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 24,
                "end": 28,
                "start_line": 1,
                "start_col": 24
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
                      "start": 30,
                      "end": 32,
                      "start_line": 1,
                      "start_col": 30
                    }
                  },
                  "op": "PostDecrement"
                }
              },
              "span": {
                "start": 30,
                "end": 34,
                "start_line": 1,
                "start_col": 30
              }
            },
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "k"
                    },
                    "span": {
                      "start": 36,
                      "end": 38,
                      "start_line": 1,
                      "start_col": 36
                    }
                  },
                  "op": "Plus",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 40,
                      "end": 41,
                      "start_line": 1,
                      "start_col": 40
                    }
                  }
                }
              },
              "span": {
                "start": 36,
                "end": 41,
                "start_line": 1,
                "start_col": 36
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 43,
              "end": 45,
              "start_line": 1,
              "start_col": 43
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 45,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45,
    "start_line": 1,
    "start_col": 0
  }
}
