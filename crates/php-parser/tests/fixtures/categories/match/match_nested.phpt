===source===
<?php $r = match($a) { 1 => match($b) { 1 => 'aa', default => 'ab' }, default => 'x' };
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
                        "Variable": "a"
                      },
                      "span": {
                        "start": 17,
                        "end": 19,
                        "start_line": 1,
                        "start_col": 17
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
                              "start": 23,
                              "end": 24,
                              "start_line": 1,
                              "start_col": 23
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Match": {
                              "subject": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 34,
                                  "end": 36,
                                  "start_line": 1,
                                  "start_col": 34
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
                                        "start": 40,
                                        "end": 41,
                                        "start_line": 1,
                                        "start_col": 40
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "aa"
                                    },
                                    "span": {
                                      "start": 45,
                                      "end": 49,
                                      "start_line": 1,
                                      "start_col": 45
                                    }
                                  },
                                  "span": {
                                    "start": 40,
                                    "end": 49,
                                    "start_line": 1,
                                    "start_col": 40
                                  }
                                },
                                {
                                  "conditions": null,
                                  "body": {
                                    "kind": {
                                      "String": "ab"
                                    },
                                    "span": {
                                      "start": 62,
                                      "end": 66,
                                      "start_line": 1,
                                      "start_col": 62
                                    }
                                  },
                                  "span": {
                                    "start": 51,
                                    "end": 66,
                                    "start_line": 1,
                                    "start_col": 51
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 28,
                            "end": 68,
                            "start_line": 1,
                            "start_col": 28
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 68,
                          "start_line": 1,
                          "start_col": 23
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "x"
                          },
                          "span": {
                            "start": 81,
                            "end": 84,
                            "start_line": 1,
                            "start_col": 81
                          }
                        },
                        "span": {
                          "start": 70,
                          "end": 84,
                          "start_line": 1,
                          "start_col": 70
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 86,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 86,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 87,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87,
    "start_line": 1,
    "start_col": 0
  }
}
