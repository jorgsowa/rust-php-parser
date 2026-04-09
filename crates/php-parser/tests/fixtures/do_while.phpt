===source===
<?php do { echo $i; $i++; } while ($i < 10);
===ast===
{
  "stmts": [
    {
      "kind": {
        "DoWhile": {
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
                          "start": 16,
                          "end": 18,
                          "start_line": 1,
                          "start_col": 16
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 11,
                    "end": 20,
                    "start_line": 1,
                    "start_col": 11
                  }
                },
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "UnaryPostfix": {
                          "operand": {
                            "kind": {
                              "Variable": "i"
                            },
                            "span": {
                              "start": 20,
                              "end": 22,
                              "start_line": 1,
                              "start_col": 20
                            }
                          },
                          "op": "PostIncrement"
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 20
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 26,
                    "start_line": 1,
                    "start_col": 20
                  }
                }
              ]
            },
            "span": {
              "start": 9,
              "end": 27,
              "start_line": 1,
              "start_col": 9
            }
          },
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "i"
                  },
                  "span": {
                    "start": 35,
                    "end": 37,
                    "start_line": 1,
                    "start_col": 35
                  }
                },
                "op": "Less",
                "right": {
                  "kind": {
                    "Int": 10
                  },
                  "span": {
                    "start": 40,
                    "end": 42,
                    "start_line": 1,
                    "start_col": 40
                  }
                }
              }
            },
            "span": {
              "start": 35,
              "end": 42,
              "start_line": 1,
              "start_col": 35
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
