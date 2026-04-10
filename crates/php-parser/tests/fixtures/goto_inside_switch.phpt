===source===
<?php
switch ($x) {
    case 1:
        goto done;
    case 2:
        echo 'two';
}
done:
echo 'done';
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
              "body": [
                {
                  "kind": {
                    "Goto": "done"
                  },
                  "span": {
                    "start": 40,
                    "end": 50
                  }
                }
              ],
              "span": {
                "start": 24,
                "end": 50
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 60,
                  "end": 61
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "two"
                        },
                        "span": {
                          "start": 76,
                          "end": 81
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 71,
                    "end": 82
                  }
                }
              ],
              "span": {
                "start": 55,
                "end": 82
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 84
      }
    },
    {
      "kind": {
        "Label": "done"
      },
      "span": {
        "start": 85,
        "end": 90
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "done"
            },
            "span": {
              "start": 96,
              "end": 102
            }
          }
        ]
      },
      "span": {
        "start": 91,
        "end": 103
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 103
  }
}
