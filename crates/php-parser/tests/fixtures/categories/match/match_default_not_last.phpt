===source===
<?php $r = match ($v) { default => 0, 1 => 1, 2 => 2 };
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
                        "Variable": "v"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 35,
                            "end": 36
                          }
                        },
                        "span": {
                          "start": 24,
                          "end": 36
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 38,
                              "end": 39
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 43,
                            "end": 44
                          }
                        },
                        "span": {
                          "start": 38,
                          "end": 44
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 46,
                              "end": 47
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 51,
                            "end": 52
                          }
                        },
                        "span": {
                          "start": 46,
                          "end": 52
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 54
          }
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
