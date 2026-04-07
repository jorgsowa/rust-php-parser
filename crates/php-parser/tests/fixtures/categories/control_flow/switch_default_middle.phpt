===source===
<?php switch ($x) { case 1: break; default: break; case 2: break; }
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
                  "start": 25,
                  "end": 26
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 28,
                    "end": 35
                  }
                }
              ],
              "span": {
                "start": 20,
                "end": 35
              }
            },
            {
              "value": null,
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 44,
                    "end": 51
                  }
                }
              ],
              "span": {
                "start": 35,
                "end": 51
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 56,
                  "end": 57
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 59,
                    "end": 66
                  }
                }
              ],
              "span": {
                "start": 51,
                "end": 66
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
