===source===
<?php $a = ['x' => 1]; $b = [...$a];
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "x"
                        },
                        "span": {
                          "start": 12,
                          "end": 15,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 19,
                          "end": 20,
                          "start_line": 1,
                          "start_col": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 12
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23,
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
                  "Variable": "b"
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 32,
                          "end": 34,
                          "start_line": 1,
                          "start_col": 32
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 29,
                        "end": 34,
                        "start_line": 1,
                        "start_col": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 28,
                  "end": 35,
                  "start_line": 1,
                  "start_col": 28
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 35,
            "start_line": 1,
            "start_col": 23
          }
        }
      },
      "span": {
        "start": 23,
        "end": 36,
        "start_line": 1,
        "start_col": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
