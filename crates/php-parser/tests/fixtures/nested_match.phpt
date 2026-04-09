===source===
<?php
$result = match ($type) {
    'a' => match ($subtype) {
        'x' => 1,
        'y' => 2,
        default => 0,
    },
    'b' => 10,
    default => -1,
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
                                        "String": "x"
                                      },
                                      "span": {
                                        "start": 70,
                                        "end": 73,
                                        "start_line": 4,
                                        "start_col": 8
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 77,
                                      "end": 78,
                                      "start_line": 4,
                                      "start_col": 15
                                    }
                                  },
                                  "span": {
                                    "start": 70,
                                    "end": 78,
                                    "start_line": 4,
                                    "start_col": 8
                                  }
                                },
                                {
                                  "conditions": [
                                    {
                                      "kind": {
                                        "String": "y"
                                      },
                                      "span": {
                                        "start": 88,
                                        "end": 91,
                                        "start_line": 5,
                                        "start_col": 8
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 95,
                                      "end": 96,
                                      "start_line": 5,
                                      "start_col": 15
                                    }
                                  },
                                  "span": {
                                    "start": 88,
                                    "end": 96,
                                    "start_line": 5,
                                    "start_col": 8
                                  }
                                },
                                {
                                  "conditions": null,
                                  "body": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 117,
                                      "end": 118,
                                      "start_line": 6,
                                      "start_col": 19
                                    }
                                  },
                                  "span": {
                                    "start": 106,
                                    "end": 118,
                                    "start_line": 6,
                                    "start_col": 8
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 125,
                            "start_line": 3,
                            "start_col": 11
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 125,
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
                              "start": 131,
                              "end": 134,
                              "start_line": 8,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 10
                          },
                          "span": {
                            "start": 138,
                            "end": 140,
                            "start_line": 8,
                            "start_col": 11
                          }
                        },
                        "span": {
                          "start": 131,
                          "end": 140,
                          "start_line": 8,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "UnaryPrefix": {
                              "op": "Negate",
                              "operand": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 158,
                                  "end": 159,
                                  "start_line": 9,
                                  "start_col": 16
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 157,
                            "end": 159,
                            "start_line": 9,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 146,
                          "end": 159,
                          "start_line": 9,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 16,
                  "end": 162,
                  "start_line": 2,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 162,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 163,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 163,
    "start_line": 1,
    "start_col": 0
  }
}
