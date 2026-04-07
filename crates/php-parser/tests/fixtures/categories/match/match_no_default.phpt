===source===
<?php $r = match($x) { 1 => 'one', 2 => 'two' };
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
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "one"
                          },
                          "span": {
                            "start": 28,
                            "end": 33
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 33
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 35,
                              "end": 36
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "two"
                          },
                          "span": {
                            "start": 40,
                            "end": 45
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 45
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 47
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
