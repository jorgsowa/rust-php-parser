===source===
<?php
$r = match(1) {
    1 => match(2) {
        2 => match(3) {
            3 => 'deep',
            default => 'x'
        },
        default => 'y'
    },
    default => 'z'
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
                  "Variable": "r"
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
                  "Match": {
                    "subject": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 17,
                        "end": 18,
                        "start_line": 2,
                        "start_col": 11
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 26,
                              "end": 27,
                              "start_line": 3,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Match": {
                              "subject": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 37,
                                  "end": 38,
                                  "start_line": 3,
                                  "start_col": 15
                                }
                              },
                              "arms": [
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "Int": 2
                                      },
                                      "span": {
                                        "start": 50,
                                        "end": 51,
                                        "start_line": 4,
                                        "start_col": 8
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "Match": {
                                        "subject": {
                                          "kind": {
                                            "Int": 3
                                          },
                                          "span": {
                                            "start": 61,
                                            "end": 62,
                                            "start_line": 4,
                                            "start_col": 19
                                          }
                                        },
                                        "arms": [
                                          {
                                            "conditions": [
                                              {
                                                "kind": {
                                                  "Int": 3
                                                },
                                                "span": {
                                                  "start": 78,
                                                  "end": 79,
                                                  "start_line": 5,
                                                  "start_col": 12
                                                }
                                              }
                                            ],
                                            "body": {
                                              "kind": {
                                                "String": "deep"
                                              },
                                              "span": {
                                                "start": 83,
                                                "end": 89,
                                                "start_line": 5,
                                                "start_col": 17
                                              }
                                            },
                                            "span": {
                                              "start": 78,
                                              "end": 89,
                                              "start_line": 5,
                                              "start_col": 12
                                            }
                                          },
                                          {
                                            "conditions": null,
                                            "body": {
                                              "kind": {
                                                "String": "x"
                                              },
                                              "span": {
                                                "start": 114,
                                                "end": 117,
                                                "start_line": 6,
                                                "start_col": 23
                                              }
                                            },
                                            "span": {
                                              "start": 103,
                                              "end": 117,
                                              "start_line": 6,
                                              "start_col": 12
                                            }
                                          }
                                        ]
                                      }
                                    },
                                    "span": {
                                      "start": 55,
                                      "end": 127,
                                      "start_line": 4,
                                      "start_col": 13
                                    }
                                  },
                                  "span": {
                                    "start": 50,
                                    "end": 127,
                                    "start_line": 4,
                                    "start_col": 8
                                  }
                                },
                                {
                                  "conditions": null,
                                  "body": {
                                    "kind": {
                                      "String": "y"
                                    },
                                    "span": {
                                      "start": 148,
                                      "end": 151,
                                      "start_line": 8,
                                      "start_col": 19
                                    }
                                  },
                                  "span": {
                                    "start": 137,
                                    "end": 151,
                                    "start_line": 8,
                                    "start_col": 8
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 157,
                            "start_line": 3,
                            "start_col": 9
                          }
                        },
                        "span": {
                          "start": 26,
                          "end": 157,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "z"
                          },
                          "span": {
                            "start": 174,
                            "end": 177,
                            "start_line": 10,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 163,
                          "end": 177,
                          "start_line": 10,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 179,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 179,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 180,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180,
    "start_line": 1,
    "start_col": 0
  }
}
