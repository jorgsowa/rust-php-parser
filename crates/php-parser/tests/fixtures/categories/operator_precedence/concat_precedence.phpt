===source===
<?php 'a' . 'b' . $c . 'd';
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
                              "String": "a"
                            },
                            "span": {
                              "start": 6,
                              "end": 9,
                              "start_line": 1,
                              "start_col": 6
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 12,
                              "end": 15,
                              "start_line": 1,
                              "start_col": 12
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
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 18,
                        "end": 20,
                        "start_line": 1,
                        "start_col": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 20,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "d"
                },
                "span": {
                  "start": 23,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 23
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
