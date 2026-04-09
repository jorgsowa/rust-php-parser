===source===
<?php

$value = match (1) {
    // list of conditions
    0, 1 => 'Foo',
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
                              "start": 58,
                              "end": 59,
                              "start_line": 5,
                              "start_col": 4
                            }
                          },
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 61,
                              "end": 62,
                              "start_line": 5,
                              "start_col": 7
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "Foo"
                          },
                          "span": {
                            "start": 66,
                            "end": 71,
                            "start_line": 5,
                            "start_col": 12
                          }
                        },
                        "span": {
                          "start": 58,
                          "end": 71,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 16,
                  "end": 74,
                  "start_line": 3,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 74,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 75,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75,
    "start_line": 1,
    "start_col": 0
  }
}
