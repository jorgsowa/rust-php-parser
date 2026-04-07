===source===
<?php $y = match($x) { 'a' => 1, 'b' => 2, default => 0 };
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
                  "Variable": "y"
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
                              "String": "a"
                            },
                            "span": {
                              "start": 23,
                              "end": 26
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 30,
                            "end": 31
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 31
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 33,
                              "end": 36
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 40,
                            "end": 41
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 41
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 54,
                            "end": 55
                          }
                        },
                        "span": {
                          "start": 43,
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
