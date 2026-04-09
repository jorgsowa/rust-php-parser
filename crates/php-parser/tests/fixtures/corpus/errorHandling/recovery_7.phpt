===source===
<?php

$i = 0;
while () {
    $j = 1;
}
$k = 2;
// The output here drops the loop - would require Error node to handle this
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
                  "Variable": "i"
                },
                "span": {
                  "start": 7,
                  "end": 9,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 12,
                  "end": 13,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 13,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 15,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": "Error",
            "span": {
              "start": 22,
              "end": 23,
              "start_line": 4,
              "start_col": 7
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "j"
                            },
                            "span": {
                              "start": 30,
                              "end": 32,
                              "start_line": 5,
                              "start_col": 4
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 35,
                              "end": 36,
                              "start_line": 5,
                              "start_col": 9
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 36,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 30,
                    "end": 38,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 24,
              "end": 39,
              "start_line": 4,
              "start_col": 9
            }
          }
        }
      },
      "span": {
        "start": 15,
        "end": 39,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "k"
                },
                "span": {
                  "start": 40,
                  "end": 42,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 45,
                  "end": 46,
                  "start_line": 7,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 40,
            "end": 46,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 40,
        "end": 123,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123,
    "start_line": 1,
    "start_col": 0
  }
}
