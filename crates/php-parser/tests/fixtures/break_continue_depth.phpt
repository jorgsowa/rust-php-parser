===source===
<?php
while (true) {
    while (true) {
        break 2;
        continue 2;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 13,
              "end": 17,
              "start_line": 2,
              "start_col": 7
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "While": {
                      "condition": {
                        "kind": {
                          "Bool": true
                        },
                        "span": {
                          "start": 32,
                          "end": 36,
                          "start_line": 3,
                          "start_col": 11
                        }
                      },
                      "body": {
                        "kind": {
                          "Block": [
                            {
                              "kind": {
                                "Break": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 54,
                                    "end": 55,
                                    "start_line": 4,
                                    "start_col": 14
                                  }
                                }
                              },
                              "span": {
                                "start": 48,
                                "end": 65,
                                "start_line": 4,
                                "start_col": 8
                              }
                            },
                            {
                              "kind": {
                                "Continue": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 74,
                                    "end": 75,
                                    "start_line": 5,
                                    "start_col": 17
                                  }
                                }
                              },
                              "span": {
                                "start": 65,
                                "end": 81,
                                "start_line": 5,
                                "start_col": 8
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 38,
                          "end": 82,
                          "start_line": 3,
                          "start_col": 17
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 82,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 19,
              "end": 84,
              "start_line": 2,
              "start_col": 13
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 84,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 84,
    "start_line": 1,
    "start_col": 0
  }
}
