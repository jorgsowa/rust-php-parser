===source===
<?php

$value = match (1) {
    0, 1, => 'Foo',
    default, => 'Bar',
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
                        "Int": 1
                      },
                      "span": {
                        "start": 23,
                        "end": 24,
                        "start_line": 3,
                        "start_col": 16
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 32,
                              "end": 33,
                              "start_line": 4,
                              "start_col": 4
                            }
                          },
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 35,
                              "end": 36,
                              "start_line": 4,
                              "start_col": 7
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "Foo"
                          },
                          "span": {
                            "start": 41,
                            "end": 46,
                            "start_line": 4,
                            "start_col": 13
                          }
                        },
                        "span": {
                          "start": 32,
                          "end": 46,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "Bar"
                          },
                          "span": {
                            "start": 64,
                            "end": 69,
                            "start_line": 5,
                            "start_col": 16
                          }
                        },
                        "span": {
                          "start": 52,
                          "end": 69,
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
