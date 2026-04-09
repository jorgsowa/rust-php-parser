===source===
<?php $x = array() === $arr;
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8,
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
                        "Array": []
                      },
                      "span": {
                        "start": 11,
                        "end": 18,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "Variable": "arr"
                      },
                      "span": {
                        "start": 23,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 27,
                  "start_line": 1,
                  "start_col": 11
                }
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
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}
