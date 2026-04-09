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
                            "String": "one"
                          },
                          "span": {
                            "start": 28,
                            "end": 33,
                            "start_line": 1,
                            "start_col": 28
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 33,
                          "start_line": 1,
                          "start_col": 23
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
                              "end": 36,
                              "start_line": 1,
                              "start_col": 35
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "two"
                          },
                          "span": {
                            "start": 40,
                            "end": 45,
                            "start_line": 1,
                            "start_col": 40
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 45,
                          "start_line": 1,
                          "start_col": 35
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 47,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 47,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
