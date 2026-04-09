===source===
<?php
$result = match ($type) {
    'a' => match ($subtype) {
        1 => 'a1',
        2 => 'a2',
        default => 'a_other',
    },
    'b' => 'b',
    default => 'other',
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
                        "Variable": "type"
                      },
                      "span": {
                        "start": 23,
                        "end": 28,
                        "start_line": 2,
                        "start_col": 17
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "String": "a"
                            },
                            "span": {
                              "start": 36,
                              "end": 39,
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
                                  "Variable": "subtype"
                                },
                                "span": {
                                  "start": 50,
                                  "end": 58,
                                  "start_line": 3,
                                  "start_col": 18
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
                                        "start": 70,
                                        "end": 71,
                                        "start_line": 4,
                                        "start_col": 8
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "a1"
                                    },
                                    "span": {
                                      "start": 75,
                                      "end": 79,
                                      "start_line": 4,
                                      "start_col": 13
                                    }
                                  },
                                  "span": {
                                    "start": 70,
                                    "end": 79,
                                    "start_line": 4,
                                    "start_col": 8
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "Int": 2
                                      },
                                      "span": {
                                        "start": 89,
                                        "end": 90,
                                        "start_line": 5,
                                        "start_col": 8
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "a2"
                                    },
                                    "span": {
                                      "start": 94,
                                      "end": 98,
                                      "start_line": 5,
                                      "start_col": 13
                                    }
                                  },
                                  "span": {
                                    "start": 89,
                                    "end": 98,
                                    "start_line": 5,
                                    "start_col": 8
                                  }
                                },
                                {
                                  "conditions": null,
                                  "body": {
                                    "kind": {
                                      "String": "a_other"
                                    },
                                    "span": {
                                      "start": 119,
                                      "end": 128,
                                      "start_line": 6,
                                      "start_col": 19
                                    }
                                  },
                                  "span": {
                                    "start": 108,
                                    "end": 128,
                                    "start_line": 6,
                                    "start_col": 8
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 135,
                            "start_line": 3,
                            "start_col": 11
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 135,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 141,
                              "end": 144,
                              "start_line": 8,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "b"
                          },
                          "span": {
                            "start": 148,
                            "end": 151,
                            "start_line": 8,
                            "start_col": 11
                          }
                        },
                        "span": {
                          "start": 141,
                          "end": 151,
                          "start_line": 8,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "other"
                          },
                          "span": {
                            "start": 168,
                            "end": 175,
                            "start_line": 9,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 157,
                          "end": 175,
                          "start_line": 9,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 16,
                  "end": 178,
                  "start_line": 2,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 178,
            "start_line": 2,
            "start_col": 0
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
  ],
  "span": {
    "start": 0,
    "end": 179,
    "start_line": 1,
    "start_col": 0
  }
}
