===source===
<?php $r = match(true) { $a > 0 => 'pos', default => 'other' };
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
                  "Variable": "r"
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
                  "Match": {
                    "subject": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 17,
                        "end": 21,
                        "start_line": 1,
                        "start_col": 17
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 25,
                                    "end": 27,
                                    "start_line": 1,
                                    "start_col": 25
                                  }
                                },
                                "op": "Greater",
                                "right": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 30,
                                    "end": 31,
                                    "start_line": 1,
                                    "start_col": 30
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 25,
                              "end": 31,
                              "start_line": 1,
                              "start_col": 25
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "pos"
                          },
                          "span": {
                            "start": 35,
                            "end": 40,
                            "start_line": 1,
                            "start_col": 35
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 40,
                          "start_line": 1,
                          "start_col": 25
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "other"
                          },
                          "span": {
                            "start": 53,
                            "end": 60,
                            "start_line": 1,
                            "start_col": 53
                          }
                        },
                        "span": {
                          "start": 42,
                          "end": 60,
                          "start_line": 1,
                          "start_col": 42
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 62,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 62,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 63,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
