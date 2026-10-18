===source===
<?php
try {
    goto a;
} finally {
    a:
}
try {
    try {
    } finally {
        goto b;
    }
} finally {
    b:
}
===errors===
jump into a finally block is disallowed
jump into a finally block is disallowed
===php_error===
PHP Fatal error:  jump into a finally block is disallowed in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Goto": {
                  "name": "a",
                  "span": {
                    "start": 21,
                    "end": 22
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 23
              }
            }
          ],
          "catches": [],
          "finally": [
            {
              "kind": {
                "Label": {
                  "name": "a",
                  "span": {
                    "start": 40,
                    "end": 41
                  }
                }
              },
              "span": {
                "start": 40,
                "end": 42
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "TryCatch": {
                  "body": [],
                  "catches": [],
                  "finally": [
                    {
                      "kind": {
                        "Goto": {
                          "name": "b",
                          "span": {
                            "start": 90,
                            "end": 91
                          }
                        }
                      },
                      "span": {
                        "start": 85,
                        "end": 92
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 55,
                "end": 98
              }
            }
          ],
          "catches": [],
          "finally": [
            {
              "kind": {
                "Label": {
                  "name": "b",
                  "span": {
                    "start": 115,
                    "end": 116
                  }
                }
              },
              "span": {
                "start": 115,
                "end": 117
              }
            }
          ]
        }
      },
      "span": {
        "start": 45,
        "end": 119
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119
  }
}
