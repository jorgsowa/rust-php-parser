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
                  "start": 25,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 25
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 28,
                    "end": 35,
                    "start_line": 1,
                    "start_col": 28
                  }
                }
              ],
              "span": {
                "start": 20,
                "end": 35,
                "start_line": 1,
                "start_col": 20
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
                    "end": 51,
                    "start_line": 1,
                    "start_col": 44
                  }
                }
              ],
              "span": {
                "start": 35,
                "end": 51,
                "start_line": 1,
                "start_col": 35
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 56,
                  "end": 57,
                  "start_line": 1,
                  "start_col": 56
                }
              },
              "body": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 59,
                    "end": 66,
                    "start_line": 1,
                    "start_col": 59
                  }
                }
              ],
              "span": {
                "start": 51,
                "end": 66,
                "start_line": 1,
                "start_col": 51
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 67,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}
