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
                  "end": 8
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
                        "end": 21
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
                                    "end": 27
                                  }
                                },
                                "op": "Greater",
                                "right": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 30,
                                    "end": 31
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 25,
                              "end": 31
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "pos"
                          },
                          "span": {
                            "start": 35,
                            "end": 40
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 40
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
                            "end": 60
                          }
                        },
                        "span": {
                          "start": 42,
                          "end": 60
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 62
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 62
          }
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
