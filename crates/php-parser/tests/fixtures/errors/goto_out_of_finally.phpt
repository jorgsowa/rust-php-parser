===source===
<?php
try {
} finally {
    goto a;
}
a:
try {
    b:
} finally {
    goto b;
}
try {
} finally {
    try {
    } finally {
        goto c;
    }
    c:
}
===errors===
jump out of a finally block is disallowed
jump out of a finally block is disallowed
jump out of a finally block is disallowed
===php_error===
PHP Fatal error:  jump out of a finally block is disallowed in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [],
          "finally": [
            {
              "kind": {
                "Goto": {
                  "name": "a",
                  "span": {
                    "start": 33,
                    "end": 34
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 35
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    },
    {
      "kind": {
        "Label": {
          "name": "a",
          "span": {
            "start": 38,
            "end": 39
          }
        }
      },
      "span": {
        "start": 38,
        "end": 40
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Label": {
                  "name": "b",
                  "span": {
                    "start": 51,
                    "end": 52
                  }
                }
              },
              "span": {
                "start": 51,
                "end": 53
              }
            }
          ],
          "catches": [],
          "finally": [
            {
              "kind": {
                "Goto": {
                  "name": "b",
                  "span": {
                    "start": 75,
                    "end": 76
                  }
                }
              },
              "span": {
                "start": 70,
                "end": 77
              }
            }
          ]
        }
      },
      "span": {
        "start": 41,
        "end": 79
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [],
          "finally": [
            {
              "kind": {
                "TryCatch": {
                  "body": [],
                  "catches": [],
                  "finally": [
                    {
                      "kind": {
                        "Goto": {
                          "name": "c",
                          "span": {
                            "start": 137,
                            "end": 138
                          }
                        }
                      },
                      "span": {
                        "start": 132,
                        "end": 139
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 102,
                "end": 145
              }
            },
            {
              "kind": {
                "Label": {
                  "name": "c",
                  "span": {
                    "start": 150,
                    "end": 151
                  }
                }
              },
              "span": {
                "start": 150,
                "end": 152
              }
            }
          ]
        }
      },
      "span": {
        "start": 80,
        "end": 154
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 154
  }
}
