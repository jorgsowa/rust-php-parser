===source===
<?php
list(list($a, $b), list($c, $d)) = $pairs;
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
                  "Array": [
                    {
                      "key": null,
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
                                  "start": 16,
                                  "end": 18,
                                  "start_line": 2,
                                  "start_col": 10
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 16,
                                "end": 18,
                                "start_line": 2,
                                "start_col": 10
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 20,
                                  "end": 22,
                                  "start_line": 2,
                                  "start_col": 14
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 20,
                                "end": 22,
                                "start_line": 2,
                                "start_col": 14
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 11,
                          "end": 23,
                          "start_line": 2,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 23,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 30,
                                  "end": 32,
                                  "start_line": 2,
                                  "start_col": 24
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 30,
                                "end": 32,
                                "start_line": 2,
                                "start_col": 24
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "d"
                                },
                                "span": {
                                  "start": 34,
                                  "end": 36,
                                  "start_line": 2,
                                  "start_col": 28
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 34,
                                "end": 36,
                                "start_line": 2,
                                "start_col": 28
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 25,
                          "end": 37,
                          "start_line": 2,
                          "start_col": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 25,
                        "end": 37,
                        "start_line": 2,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 38,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "pairs"
                },
                "span": {
                  "start": 41,
                  "end": 47,
                  "start_line": 2,
                  "start_col": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 47,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
