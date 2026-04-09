===source===
<?php for ($a=0, $b=1, $c=2; $a < 10; $a++) {}
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
                      "Variable": "a"
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
            },
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 17,
                      "end": 19,
                      "start_line": 1,
                      "start_col": 17
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 20,
                      "end": 21,
                      "start_line": 1,
                      "start_col": 20
                    }
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 21,
                "start_line": 1,
                "start_col": 17
              }
            },
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 23,
                      "end": 25,
                      "start_line": 1,
                      "start_col": 23
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 26,
                      "end": 27,
                      "start_line": 1,
                      "start_col": 26
                    }
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 27,
                "start_line": 1,
                "start_col": 23
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 29,
                      "end": 31,
                      "start_line": 1,
                      "start_col": 29
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 34,
                      "end": 36,
                      "start_line": 1,
                      "start_col": 34
                    }
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 36,
                "start_line": 1,
                "start_col": 29
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 38,
                      "end": 40,
                      "start_line": 1,
                      "start_col": 38
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 38,
                "end": 42,
                "start_line": 1,
                "start_col": 38
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 44,
              "end": 46,
              "start_line": 1,
              "start_col": 44
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 46,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46,
    "start_line": 1,
    "start_col": 0
  }
}
