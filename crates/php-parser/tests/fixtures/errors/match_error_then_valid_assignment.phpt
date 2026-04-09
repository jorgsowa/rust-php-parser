===source===
<?php $x = match ($y) { 1 => }; $z = 42;
===errors===
expected expression
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
                        "Variable": "y"
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
                          "kind": "Error",
                          "span": {
                            "start": 29,
                            "end": 30,
                            "start_line": 1,
                            "start_col": 29
                          }
                        },
                        "span": {
                          "start": 24,
                          "end": 30,
                          "start_line": 1,
                          "start_col": 24
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 30,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 32,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 32
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 42
                },
                "span": {
                  "start": 37,
                  "end": 39,
                  "start_line": 1,
                  "start_col": 37
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 39,
            "start_line": 1,
            "start_col": 32
          }
        }
      },
      "span": {
        "start": 32,
        "end": 40,
        "start_line": 1,
        "start_col": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40,
    "start_line": 1,
    "start_col": 0
  }
}
