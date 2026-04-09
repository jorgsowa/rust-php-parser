===source===
<?php
// This is legal.
isset(($a), (($b)));
// This is illegal, but not a syntax error.
isset(1 + 1);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 31,
                      "end": 33,
                      "start_line": 3,
                      "start_col": 7
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 34,
                  "start_line": 3,
                  "start_col": 6
                }
              },
              {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 38,
                          "end": 40,
                          "start_line": 3,
                          "start_col": 14
                        }
                      }
                    },
                    "span": {
                      "start": 37,
                      "end": 41,
                      "start_line": 3,
                      "start_col": 13
                    }
                  }
                },
                "span": {
                  "start": 36,
                  "end": 42,
                  "start_line": 3,
                  "start_col": 12
                }
              }
            ]
          },
          "span": {
            "start": 24,
            "end": 43,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 24,
        "end": 89,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 95,
                        "end": 96,
                        "start_line": 5,
                        "start_col": 6
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 99,
                        "end": 100,
                        "start_line": 5,
                        "start_col": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 95,
                  "end": 100,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 89,
            "end": 101,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 89,
        "end": 102,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102,
    "start_line": 1,
    "start_col": 0
  }
}
