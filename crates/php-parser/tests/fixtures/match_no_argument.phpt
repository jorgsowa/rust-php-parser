===source===
<?php
$result = match (true) {
    $x > 0 => 'positive',
    $x < 0 => 'negative',
    default => 'zero',
};
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
                  "Variable": "result"
                },
                "span": {
                  "start": 6,
                  "end": 13,
                  "start_line": 2,
                  "start_col": 0
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
                        "start": 23,
                        "end": 27,
                        "start_line": 2,
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
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 35,
                                    "end": 37,
                                    "start_line": 3,
                                    "start_col": 4
                                  }
                                },
                                "op": "Greater",
                                "right": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 40,
                                    "end": 41,
                                    "start_line": 3,
                                    "start_col": 9
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 35,
                              "end": 41,
                              "start_line": 3,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "positive"
                          },
                          "span": {
                            "start": 45,
                            "end": 55,
                            "start_line": 3,
                            "start_col": 14
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 55,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 61,
                                    "end": 63,
                                    "start_line": 4,
                                    "start_col": 4
                                  }
                                },
                                "op": "Less",
                                "right": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 66,
                                    "end": 67,
                                    "start_line": 4,
                                    "start_col": 9
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 61,
                              "end": 67,
                              "start_line": 4,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "negative"
                          },
                          "span": {
                            "start": 71,
                            "end": 81,
                            "start_line": 4,
                            "start_col": 14
                          }
                        },
                        "span": {
                          "start": 61,
                          "end": 81,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "zero"
                          },
                          "span": {
                            "start": 98,
                            "end": 104,
                            "start_line": 5,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 87,
                          "end": 104,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 16,
                  "end": 107,
                  "start_line": 2,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 107,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 108,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 108,
    "start_line": 1,
    "start_col": 0
  }
}
