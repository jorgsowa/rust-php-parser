===source===
<?php $r = match($x) { 1 => 'ok', default => throw new Exception() };
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
                            "String": "ok"
                          },
                          "span": {
                            "start": 28,
                            "end": 32
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 32
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "ThrowExpr": {
                              "kind": {
                                "New": {
                                  "class": {
                                    "kind": {
                                      "Identifier": "Exception"
                                    },
                                    "span": {
                                      "start": 55,
                                      "end": 64
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 51,
                                "end": 67
                              }
                            }
                          },
                          "span": {
                            "start": 45,
                            "end": 67
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 67
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 68
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 68
          }
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
