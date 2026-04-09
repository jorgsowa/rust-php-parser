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
                              "String": "a"
                            },
                            "span": {
                              "start": 23,
                              "end": 26,
                              "start_line": 1,
                              "start_col": 23
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 30,
                            "end": 31,
                            "start_line": 1,
                            "start_col": 30
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 31,
                          "start_line": 1,
                          "start_col": 23
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
                              "end": 36,
                              "start_line": 1,
                              "start_col": 33
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 40,
                            "end": 41,
                            "start_line": 1,
                            "start_col": 40
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 41,
                          "start_line": 1,
                          "start_col": 33
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
                            "end": 55,
                            "start_line": 1,
                            "start_col": 54
                          }
                        },
                        "span": {
                          "start": 43,
                          "end": 55,
                          "start_line": 1,
                          "start_col": 43
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 57,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 57,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 58,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58,
    "start_line": 1,
    "start_col": 0
  }
}
