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
                  "end": 8
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
                        "end": 19
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
                              "end": 24
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
                                  "end": 36
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
                                        "end": 41
                                      }
                                    }
                                  ],
                                  "body": {
                                    "kind": {
                                      "String": "aa"
                                    },
                                    "span": {
                                      "start": 45,
                                      "end": 49
                                    }
                                  },
                                  "span": {
                                    "start": 40,
                                    "end": 49
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
                                      "end": 66
                                    }
                                  },
                                  "span": {
                                    "start": 51,
                                    "end": 66
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 28,
                            "end": 68
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 68
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
                            "end": 84
                          }
                        },
                        "span": {
                          "start": 70,
                          "end": 84
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 86
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 86
          }
        }
      },
      "span": {
        "start": 6,
        "end": 87
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87
  }
}
