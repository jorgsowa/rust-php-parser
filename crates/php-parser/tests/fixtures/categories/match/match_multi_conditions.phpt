===source===
<?php $r = match($x) { 1, 2, 3 => 'low', 4, 5 => 'high' };
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
                        "Variable": "x"
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
                          },
                          {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 26,
                              "end": 27
                            }
                          },
                          {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 29,
                              "end": 30
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "low"
                          },
                          "span": {
                            "start": 34,
                            "end": 39
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 39
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 4
                            },
                            "span": {
                              "start": 41,
                              "end": 42
                            }
                          },
                          {
                            "kind": {
                              "Int": 5
                            },
                            "span": {
                              "start": 44,
                              "end": 45
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "high"
                          },
                          "span": {
                            "start": 49,
                            "end": 55
                          }
                        },
                        "span": {
                          "start": 41,
                          "end": 55
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 57
          }
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
