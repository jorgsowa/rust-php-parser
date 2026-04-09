===source===
<?php [$a, [$b, [$c, [$d]]]] = $arr;
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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 7,
                          "end": 9,
                          "start_line": 1,
                          "start_col": 7
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 9,
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
                                          "start": 17,
                                          "end": 19,
                                          "start_line": 1,
                                          "start_col": 17
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 17,
                                        "end": 19,
                                        "start_line": 1,
                                        "start_col": 17
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
                                          "start": 21,
                                          "end": 25,
                                          "start_line": 1,
                                          "start_col": 21
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 21,
                                        "end": 25,
                                        "start_line": 1,
                                        "start_col": 21
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 16,
                                  "end": 26,
                                  "start_line": 1,
                                  "start_col": 16
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 16,
                                "end": 26,
                                "start_line": 1,
                                "start_col": 16
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 11,
                          "end": 27,
                          "start_line": 1,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 11
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 28,
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
                  "start": 31,
                  "end": 35,
                  "start_line": 1,
                  "start_col": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36,
        "start_line": 1,
        "start_col": 6
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
