===source===
<?php 1 << 2 . 3 << 4;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 6,
                        "end": 7,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "op": "ShiftLeft",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 11,
                              "end": 12,
                              "start_line": 1,
                              "start_col": 11
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 15,
                              "end": 16,
                              "start_line": 1,
                              "start_col": 15
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 16,
                        "start_line": 1,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "ShiftLeft",
              "right": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 20,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
