===source===
<?php 1 + 2 . 3 + 4;
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
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 10,
                              "end": 11,
                              "start_line": 1,
                              "start_col": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 11,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 14,
                        "end": 15,
                        "start_line": 1,
                        "start_col": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20,
    "start_line": 1,
    "start_col": 0
  }
}
