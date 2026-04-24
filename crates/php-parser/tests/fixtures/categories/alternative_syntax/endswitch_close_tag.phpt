===source===
<?php switch ($x): case 1: echo 1; break; endswitch ?>
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
                          "Int": 1
                        },
                        "span": {
                          "start": 32,
                          "end": 33
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 27,
                    "end": 34
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 35,
                    "end": 41
                  }
                }
              ],
              "span": {
                "start": 19,
                "end": 41
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
