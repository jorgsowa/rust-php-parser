===source===
<?php $line = __LINE__ + 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "line"
                },
                "span": {
                  "start": 6,
                  "end": 11,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "MagicConst": "Line"
                      },
                      "span": {
                        "start": 14,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 14
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 25,
                        "end": 26,
                        "start_line": 1,
                        "start_col": 25
                      }
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27,
    "start_line": 1,
    "start_col": 0
  }
}
