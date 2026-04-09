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
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
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
                        "end": 19,
                        "start_line": 1,
                        "start_col": 17
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
                              "end": 24,
                              "start_line": 1,
                              "start_col": 23
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "ok"
                          },
                          "span": {
                            "start": 28,
                            "end": 32,
                            "start_line": 1,
                            "start_col": 28
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 32,
                          "start_line": 1,
                          "start_col": 23
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
                                      "end": 64,
                                      "start_line": 1,
                                      "start_col": 55
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 51,
                                "end": 67,
                                "start_line": 1,
                                "start_col": 51
                              }
                            }
                          },
                          "span": {
                            "start": 45,
                            "end": 67,
                            "start_line": 1,
                            "start_col": 45
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 67,
                          "start_line": 1,
                          "start_col": 34
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 68,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 68,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 69,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69,
    "start_line": 1,
    "start_col": 0
  }
}
