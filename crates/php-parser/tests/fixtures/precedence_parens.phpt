===source===
<?php (1 + 2) * 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 7,
                            "end": 8,
                            "start_line": 1,
                            "start_col": 7
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 11,
                            "end": 12,
                            "start_line": 1,
                            "start_col": 11
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 12,
                      "start_line": 1,
                      "start_col": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 16,
                  "end": 17,
                  "start_line": 1,
                  "start_col": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18,
    "start_line": 1,
    "start_col": 0
  }
}
