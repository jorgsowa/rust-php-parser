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
              "end": 16,
              "start_line": 1,
              "start_col": 14
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
                    "end": 36,
                    "start_line": 1,
                    "start_col": 29
                  }
                }
              ],
              "span": {
                "start": 20,
                "end": 36,
                "start_line": 1,
                "start_col": 20
              }
            },
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 41,
                  "end": 42,
                  "start_line": 1,
                  "start_col": 41
                }
              },
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
                "start": 36,
                "end": 51,
                "start_line": 1,
                "start_col": 36
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
                    "end": 67,
                    "start_line": 1,
                    "start_col": 60
                  }
                }
              ],
              "span": {
                "start": 51,
                "end": 67,
                "start_line": 1,
                "start_col": 51
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 68,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68,
    "start_line": 1,
    "start_col": 0
  }
}
