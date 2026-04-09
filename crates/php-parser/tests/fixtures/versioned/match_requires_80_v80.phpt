===config===
parse_version=8.0
===source===
<?php $x = match($y) { 1 => 'a', default => 'b' };
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
                            "String": "a"
                          },
                          "span": {
                            "start": 28,
                            "end": 31,
                            "start_line": 1,
                            "start_col": 28
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
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "b"
                          },
                          "span": {
                            "start": 44,
                            "end": 47,
                            "start_line": 1,
                            "start_col": 44
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 47,
                          "start_line": 1,
                          "start_col": 33
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 49,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 49,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}
