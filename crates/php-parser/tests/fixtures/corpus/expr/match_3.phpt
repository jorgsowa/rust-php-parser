===source===
<?php

$result = match ($operator) {
    BinaryOperator::ADD => $lhs + $rhs,
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
                  "start": 7,
                  "end": 14,
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
                        "Variable": "operator"
                      },
                      "span": {
                        "start": 24,
                        "end": 33,
                        "start_line": 3,
                        "start_col": 17
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Identifier": "BinaryOperator"
                                  },
                                  "span": {
                                    "start": 41,
                                    "end": 55,
                                    "start_line": 4,
                                    "start_col": 4
                                  }
                                },
                                "member": "ADD"
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 61,
                              "start_line": 4,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "lhs"
                                },
                                "span": {
                                  "start": 64,
                                  "end": 68,
                                  "start_line": 4,
                                  "start_col": 27
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Variable": "rhs"
                                },
                                "span": {
                                  "start": 71,
                                  "end": 75,
                                  "start_line": 4,
                                  "start_col": 34
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 64,
                            "end": 75,
                            "start_line": 4,
                            "start_col": 27
                          }
                        },
                        "span": {
                          "start": 41,
                          "end": 75,
                          "start_line": 4,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 17,
                  "end": 78,
                  "start_line": 3,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 78,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 79,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79,
    "start_line": 1,
    "start_col": 0
  }
}
