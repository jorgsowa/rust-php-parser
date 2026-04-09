===source===
<?php
call(...$args);
$merged = [...$a, ...$b, 1, 2];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "call"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "args"
                    },
                    "span": {
                      "start": 14,
                      "end": 19,
                      "start_line": 2,
                      "start_col": 8
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 19,
                    "start_line": 2,
                    "start_col": 5
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
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
                  "Variable": "merged"
                },
                "span": {
                  "start": 22,
                  "end": 29,
                  "start_line": 3,
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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 36,
                          "end": 38,
                          "start_line": 3,
                          "start_col": 14
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 33,
                        "end": 38,
                        "start_line": 3,
                        "start_col": 11
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 43,
                          "end": 45,
                          "start_line": 3,
                          "start_col": 21
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 40,
                        "end": 45,
                        "start_line": 3,
                        "start_col": 18
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 47,
                          "end": 48,
                          "start_line": 3,
                          "start_col": 25
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 47,
                        "end": 48,
                        "start_line": 3,
                        "start_col": 25
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 50,
                          "end": 51,
                          "start_line": 3,
                          "start_col": 28
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 50,
                        "end": 51,
                        "start_line": 3,
                        "start_col": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 32,
                  "end": 52,
                  "start_line": 3,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 52,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 53,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
