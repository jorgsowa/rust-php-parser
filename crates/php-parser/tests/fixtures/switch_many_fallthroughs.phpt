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
              "end": 16
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
                  "end": 30
                }
              },
              "body": [],
              "span": {
                "start": 24,
                "end": 31
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 41,
                  "end": 42
                }
              },
              "body": [],
              "span": {
                "start": 36,
                "end": 43
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 53,
                  "end": 54
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
                          "end": 74
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 64,
                    "end": 75
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 84,
                    "end": 90
                  }
                }
              ],
              "span": {
                "start": 48,
                "end": 90
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 100,
                  "end": 101
                }
              },
              "body": [],
              "span": {
                "start": 95,
                "end": 102
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 5
                },
                "span": {
                  "start": 112,
                  "end": 113
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
                          "end": 133
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 123,
                    "end": 134
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 143,
                    "end": 149
                  }
                }
              ],
              "span": {
                "start": 107,
                "end": 149
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
                          "end": 183
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 171,
                    "end": 184
                  }
                }
              ],
              "span": {
                "start": 154,
                "end": 184
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 186
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 186
  }
}
