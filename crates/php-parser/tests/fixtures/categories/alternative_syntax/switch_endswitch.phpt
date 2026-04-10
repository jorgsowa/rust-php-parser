===source===
<?php switch ($x): case 1: echo 'one'; break; default: echo 'other'; endswitch;
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
                  "start": 24,
                  "end": 25
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
                          "start": 32,
                          "end": 37
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 27,
                    "end": 38
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 39,
                    "end": 45
                  }
                }
              ],
              "span": {
                "start": 19,
                "end": 45
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
                          "start": 60,
                          "end": 67
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 55,
                    "end": 68
                  }
                }
              ],
              "span": {
                "start": 46,
                "end": 68
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 79
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79
  }
}
