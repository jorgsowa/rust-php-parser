===source===
<?php
switch ($x) {
    case 1:
        echo 'one';
        break;
    case 2:
    case 3:
        echo 'two or three';
        break;
    default:
        echo 'other';
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 14,
              "end": 16,
              "start_line": 2,
              "start_col": 8
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 29,
                  "end": 30,
                  "start_line": 3,
                  "start_col": 9
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "one"
                        },
                        "span": {
                          "start": 45,
                          "end": 50,
                          "start_line": 4,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 40,
                    "end": 60,
                    "start_line": 4,
                    "start_col": 8
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 60,
                    "end": 71,
                    "start_line": 5,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 24,
                "end": 71,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 76,
                  "end": 77,
                  "start_line": 6,
                  "start_col": 9
                }
              },
              "body": [],
              "span": {
                "start": 71,
                "end": 83,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 88,
                  "end": 89,
                  "start_line": 7,
                  "start_col": 9
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "two or three"
                        },
                        "span": {
                          "start": 104,
                          "end": 118,
                          "start_line": 8,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 99,
                    "end": 128,
                    "start_line": 8,
                    "start_col": 8
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 128,
                    "end": 139,
                    "start_line": 9,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 83,
                "end": 139,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "value": null,
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "other"
                        },
                        "span": {
                          "start": 161,
                          "end": 168,
                          "start_line": 11,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 156,
                    "end": 170,
                    "start_line": 11,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 139,
                "end": 170,
                "start_line": 10,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 171,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 171,
    "start_line": 1,
    "start_col": 0
  }
}
