===source===
<?php
$x = [1, 2, 3;
$y = 4;
===errors===
expected ']', found ';'
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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 12,
                          "end": 13,
                          "start_line": 2,
                          "start_col": 6
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 13,
                        "start_line": 2,
                        "start_col": 6
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 15,
                          "end": 16,
                          "start_line": 2,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 16,
                        "start_line": 2,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 18,
                          "end": 19,
                          "start_line": 2,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 18,
                        "end": 19,
                        "start_line": 2,
                        "start_col": 12
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 19,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 2,
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
                  "Variable": "y"
                },
                "span": {
                  "start": 21,
                  "end": 23,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 26,
                  "end": 27,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 27,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 21,
        "end": 28,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}
