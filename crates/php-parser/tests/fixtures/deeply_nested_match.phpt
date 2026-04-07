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
                  "end": 8
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
                        "end": 18
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
                              "end": 27
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
                                  "end": 38
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
                                        "end": 51
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
                                            "end": 62
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
                                                  "end": 79
                                                }
                                              }
                                            ],
                                            "body": {
                                              "kind": {
                                                "String": "deep"
                                              },
                                              "span": {
                                                "start": 83,
                                                "end": 89
                                              }
                                            },
                                            "span": {
                                              "start": 78,
                                              "end": 89
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
                                                "end": 117
                                              }
                                            },
                                            "span": {
                                              "start": 103,
                                              "end": 117
                                            }
                                          }
                                        ]
                                      }
                                    },
                                    "span": {
                                      "start": 55,
                                      "end": 127
                                    }
                                  },
                                  "span": {
                                    "start": 50,
                                    "end": 127
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
                                      "end": 151
                                    }
                                  },
                                  "span": {
                                    "start": 137,
                                    "end": 151
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 157
                          }
                        },
                        "span": {
                          "start": 26,
                          "end": 157
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
                            "end": 177
                          }
                        },
                        "span": {
                          "start": 163,
                          "end": 177
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 179
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 179
          }
        }
      },
      "span": {
        "start": 6,
        "end": 180
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 180
  }
}
