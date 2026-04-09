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
                        "Variable": "v"
                      },
                      "span": {
                        "start": 18,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 18
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
                              "end": 25,
                              "start_line": 1,
                              "start_col": 24
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "one"
                          },
                          "span": {
                            "start": 29,
                            "end": 34,
                            "start_line": 1,
                            "start_col": 29
                          }
                        },
                        "span": {
                          "start": 24,
                          "end": 34,
                          "start_line": 1,
                          "start_col": 24
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
                            "end": 54,
                            "start_line": 1,
                            "start_col": 47
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 54,
                          "start_line": 1,
                          "start_col": 36
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
                            "end": 75,
                            "start_line": 1,
                            "start_col": 67
                          }
                        },
                        "span": {
                          "start": 56,
                          "end": 75,
                          "start_line": 1,
                          "start_col": 56
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 77,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 77,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 78,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 78,
    "start_line": 1,
    "start_col": 0
  }
}
