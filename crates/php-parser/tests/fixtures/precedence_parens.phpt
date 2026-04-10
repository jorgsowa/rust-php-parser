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
                            "end": 8
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 12
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 16,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
