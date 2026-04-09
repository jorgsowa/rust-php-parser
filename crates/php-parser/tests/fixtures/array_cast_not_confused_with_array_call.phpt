===source===
<?php $a = (array) $x;
$b = array() === [];
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
                  "Variable": "a"
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
                  "Cast": [
                    "Array",
                    {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 19,
                        "end": 21,
                        "start_line": 1,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 11
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
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 23,
                  "end": 25,
                  "start_line": 2,
                  "start_col": 0
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
                        "start": 28,
                        "end": 35,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 40,
                        "end": 42,
                        "start_line": 2,
                        "start_col": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 42,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 42,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 23,
        "end": 43,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}
