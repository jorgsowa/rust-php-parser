===source===
<?php switch ($x) { default: break; case 1: break; default: break; }
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
              "value": null,
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 29,
                    "end": 36
                  }
                }
              ],
              "span": {
                "start": 20,
                "end": 36
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 41,
                  "end": 42
                }
              },
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
                "start": 36,
                "end": 51
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
                    "start": 60,
                    "end": 67
                  }
                }
              ],
              "span": {
                "start": 51,
                "end": 67
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
