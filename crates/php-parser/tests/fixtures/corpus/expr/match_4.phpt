===source===
<?php

$value = match ($char) {
    1 => '1',
    default => 'default'
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
                  "Variable": "value"
                },
                "span": {
                  "start": 7,
                  "end": 13,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "char"
                      },
                      "span": {
                        "start": 23,
                        "end": 28,
                        "start_line": 3,
                        "start_col": 16
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
                              "start": 36,
                              "end": 37,
                              "start_line": 4,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "1"
                          },
                          "span": {
                            "start": 41,
                            "end": 44,
                            "start_line": 4,
                            "start_col": 9
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 44,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "default"
                          },
                          "span": {
                            "start": 61,
                            "end": 70,
                            "start_line": 5,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 70,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 16,
                  "end": 72,
                  "start_line": 3,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 72,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 73,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73,
    "start_line": 1,
    "start_col": 0
  }
}
