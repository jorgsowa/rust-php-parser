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
              "body": [
                {
                  "kind": {
                    "Goto": "done"
                  },
                  "span": {
                    "start": 40,
                    "end": 55,
                    "start_line": 4,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 24,
                "end": 55,
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
                  "start": 60,
                  "end": 61,
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
                          "String": "two"
                        },
                        "span": {
                          "start": 76,
                          "end": 81,
                          "start_line": 6,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 71,
                    "end": 83,
                    "start_line": 6,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 55,
                "end": 83,
                "start_line": 5,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 85,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Label": "done"
      },
      "span": {
        "start": 85,
        "end": 91,
        "start_line": 8,
        "start_col": 0
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
              "end": 102,
              "start_line": 9,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 91,
        "end": 103,
        "start_line": 9,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 103,
    "start_line": 1,
    "start_col": 0
  }
}
