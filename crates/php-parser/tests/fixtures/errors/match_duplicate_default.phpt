===source===
<?php $x = match ($v) { 1 => 'one', default => 'first', default => 'second' };
===errors===
match expression may only contain one default arm
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
                  "Variable": "x"
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
                        "conditions": [
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "one"
                          },
                          "span": {
                            "start": 29,
                            "end": 34
                          }
                        },
                        "span": {
                          "start": 24,
                          "end": 34
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "first"
                          },
                          "span": {
                            "start": 47,
                            "end": 54
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 54
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "second"
                          },
                          "span": {
                            "start": 67,
                            "end": 75
                          }
                        },
                        "span": {
                          "start": 56,
                          "end": 75
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 77
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 77
          }
        }
      },
      "span": {
        "start": 6,
        "end": 78
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 78
  }
}
