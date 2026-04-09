===source===
<?php for ($i = 0; $i < 10; $i++): echo $i; endfor;
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
                      "start": 19,
                      "end": 21,
                      "start_line": 1,
                      "start_col": 19
                    }
                  },
                  "op": "Less",
                  "right": {
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
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
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
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 28,
                "end": 32,
                "start_line": 1,
                "start_col": 28
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
                          "start": 40,
                          "end": 42,
                          "start_line": 1,
                          "start_col": 40
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 35,
                    "end": 44,
                    "start_line": 1,
                    "start_col": 35
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 51,
              "start_line": 1,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 51,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51,
    "start_line": 1,
    "start_col": 0
  }
}
