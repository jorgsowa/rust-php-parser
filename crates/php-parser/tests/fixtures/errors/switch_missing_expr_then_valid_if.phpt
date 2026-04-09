===source===
<?php switch () { case 1: break; } if (true) { echo 'ok'; }
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": "Error",
            "span": {
              "start": 14,
              "end": 15,
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
                  "start": 23,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 23
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 26,
                    "end": 33,
                    "start_line": 1,
                    "start_col": 26
                  }
                }
              ],
              "span": {
                "start": 18,
                "end": 33,
                "start_line": 1,
                "start_col": 18
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 39,
              "end": 43,
              "start_line": 1,
              "start_col": 39
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "ok"
                        },
                        "span": {
                          "start": 52,
                          "end": 56,
                          "start_line": 1,
                          "start_col": 52
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 47,
                    "end": 58,
                    "start_line": 1,
                    "start_col": 47
                  }
                }
              ]
            },
            "span": {
              "start": 45,
              "end": 59,
              "start_line": 1,
              "start_col": 45
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 35,
        "end": 59,
        "start_line": 1,
        "start_col": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59,
    "start_line": 1,
    "start_col": 0
  }
}
