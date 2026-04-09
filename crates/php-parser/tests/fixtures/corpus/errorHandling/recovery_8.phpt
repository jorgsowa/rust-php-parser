===source===
<?php
// Can't recover this yet, as the '}' for the inner_statement_list
// is always required.

$i = 0;
while (true) {
    $i = 1;
    $i = 2;
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
                  "start": 97,
                  "end": 99,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 102,
                  "end": 103,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 97,
            "end": 103,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 97,
        "end": 105,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 112,
              "end": 116,
              "start_line": 6,
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
                              "Variable": "i"
                            },
                            "span": {
                              "start": 124,
                              "end": 126,
                              "start_line": 7,
                              "start_col": 4
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 129,
                              "end": 130,
                              "start_line": 7,
                              "start_col": 9
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 124,
                        "end": 130,
                        "start_line": 7,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 124,
                    "end": 136,
                    "start_line": 7,
                    "start_col": 4
                  }
                },
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
                              "start": 136,
                              "end": 138,
                              "start_line": 8,
                              "start_col": 4
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 141,
                              "end": 142,
                              "start_line": 8,
                              "start_col": 9
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 136,
                        "end": 142,
                        "start_line": 8,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 136,
                    "end": 143,
                    "start_line": 8,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 118,
              "end": 143,
              "start_line": 6,
              "start_col": 13
            }
          }
        }
      },
      "span": {
        "start": 105,
        "end": 143,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 143,
    "start_line": 1,
    "start_col": 0
  }
}
