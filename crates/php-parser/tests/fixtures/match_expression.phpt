===source===
<?php
$result = match ($x) {
    'a', 'b' => 'first',
    'c' => 'second',
    default => 'other',
};
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
                  "Variable": "result"
                },
                "span": {
                  "start": 6,
                  "end": 13,
                  "start_line": 2,
                  "start_col": 0
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
                        "start": 23,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 17
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
                              "start": 33,
                              "end": 36,
                              "start_line": 3,
                              "start_col": 4
                            }
                          },
                          {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 38,
                              "end": 41,
                              "start_line": 3,
                              "start_col": 9
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "first"
                          },
                          "span": {
                            "start": 45,
                            "end": 52,
                            "start_line": 3,
                            "start_col": 16
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 52,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "String": "c"
                            },
                            "span": {
                              "start": 58,
                              "end": 61,
                              "start_line": 4,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "second"
                          },
                          "span": {
                            "start": 65,
                            "end": 73,
                            "start_line": 4,
                            "start_col": 11
                          }
                        },
                        "span": {
                          "start": 58,
                          "end": 73,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "other"
                          },
                          "span": {
                            "start": 90,
                            "end": 97,
                            "start_line": 5,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 79,
                          "end": 97,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 16,
                  "end": 100,
                  "start_line": 2,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 100,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 101,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 101,
    "start_line": 1,
    "start_col": 0
  }
}
