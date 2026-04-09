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
              "end": 16,
              "start_line": 1,
              "start_col": 14
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
                  "end": 25,
                  "start_line": 1,
                  "start_col": 24
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
                          "end": 37,
                          "start_line": 1,
                          "start_col": 32
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 27,
                    "end": 39,
                    "start_line": 1,
                    "start_col": 27
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 39,
                    "end": 46,
                    "start_line": 1,
                    "start_col": 39
                  }
                }
              ],
              "span": {
                "start": 19,
                "end": 46,
                "start_line": 1,
                "start_col": 19
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
                          "end": 67,
                          "start_line": 1,
                          "start_col": 60
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 55,
                    "end": 69,
                    "start_line": 1,
                    "start_col": 55
                  }
                }
              ],
              "span": {
                "start": 46,
                "end": 69,
                "start_line": 1,
                "start_col": 46
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 79,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 79,
    "start_line": 1,
    "start_col": 0
  }
}
