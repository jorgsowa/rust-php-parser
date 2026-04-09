===source===
<?php
switch ($x) {
    case 1:
    case 2:
    case 3:
        echo "1-3";
        break;
    case 4:
    case 5:
        echo "4-5";
        break;
    default:
        echo "other";
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
              "body": [],
              "span": {
                "start": 24,
                "end": 36,
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
                  "start": 41,
                  "end": 42,
                  "start_line": 4,
                  "start_col": 9
                }
              },
              "body": [],
              "span": {
                "start": 36,
                "end": 48,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 53,
                  "end": 54,
                  "start_line": 5,
                  "start_col": 9
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "1-3"
                        },
                        "span": {
                          "start": 69,
                          "end": 74,
                          "start_line": 6,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 64,
                    "end": 84,
                    "start_line": 6,
                    "start_col": 8
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 84,
                    "end": 95,
                    "start_line": 7,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 48,
                "end": 95,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 100,
                  "end": 101,
                  "start_line": 8,
                  "start_col": 9
                }
              },
              "body": [],
              "span": {
                "start": 95,
                "end": 107,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 5
                },
                "span": {
                  "start": 112,
                  "end": 113,
                  "start_line": 9,
                  "start_col": 9
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "4-5"
                        },
                        "span": {
                          "start": 128,
                          "end": 133,
                          "start_line": 10,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 123,
                    "end": 143,
                    "start_line": 10,
                    "start_col": 8
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 143,
                    "end": 154,
                    "start_line": 11,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 107,
                "end": 154,
                "start_line": 9,
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
                          "start": 176,
                          "end": 183,
                          "start_line": 13,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 171,
                    "end": 185,
                    "start_line": 13,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 154,
                "end": 185,
                "start_line": 12,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 186,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 186,
    "start_line": 1,
    "start_col": 0
  }
}
