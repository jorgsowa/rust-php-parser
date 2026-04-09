===source===
<?php
switch ($x) {
    case 1
        echo "one";
        break;
    case 2:
        echo "two";
}
===errors===
expected ';', found 'echo'
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
                    "Echo": [
                      {
                        "kind": {
                          "String": "one"
                        },
                        "span": {
                          "start": 44,
                          "end": 49,
                          "start_line": 4,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 39,
                    "end": 59,
                    "start_line": 4,
                    "start_col": 8
                  }
                },
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 59,
                    "end": 70,
                    "start_line": 5,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 24,
                "end": 70,
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
                  "start": 75,
                  "end": 76,
                  "start_line": 6,
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
                          "start": 91,
                          "end": 96,
                          "start_line": 7,
                          "start_col": 13
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 86,
                    "end": 98,
                    "start_line": 7,
                    "start_col": 8
                  }
                }
              ],
              "span": {
                "start": 70,
                "end": 98,
                "start_line": 6,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 99,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99,
    "start_line": 1,
    "start_col": 0
  }
}
