===source===
<?php [[$a, $b], [$c, $d]] = $arr;
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
                                  "start": 8,
                                  "end": 10,
                                  "start_line": 1,
                                  "start_col": 8
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 8,
                                "end": 10,
                                "start_line": 1,
                                "start_col": 8
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 12,
                                  "end": 14,
                                  "start_line": 1,
                                  "start_col": 12
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 12,
                                "end": 14,
                                "start_line": 1,
                                "start_col": 12
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 7,
                          "end": 15,
                          "start_line": 1,
                          "start_col": 7
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 15,
                        "start_line": 1,
                        "start_col": 7
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
                                  "start": 18,
                                  "end": 20,
                                  "start_line": 1,
                                  "start_col": 18
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 18,
                                "end": 20,
                                "start_line": 1,
                                "start_col": 18
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "d"
                                },
                                "span": {
                                  "start": 22,
                                  "end": 24,
                                  "start_line": 1,
                                  "start_col": 22
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 22,
                                "end": 24,
                                "start_line": 1,
                                "start_col": 22
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 17,
                          "end": 25,
                          "start_line": 1,
                          "start_col": 17
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 17,
                        "end": 25,
                        "start_line": 1,
                        "start_col": 17
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 29,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
