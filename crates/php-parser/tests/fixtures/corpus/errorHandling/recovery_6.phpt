===source===
<?php

$i = 0;
while

$j = 1;
$k = 2;
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
                  "Variable": "i"
                },
                "span": {
                  "start": 7,
                  "end": 9,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 12,
                  "end": 13,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 13,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 15,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Assign": {
                "target": {
                  "kind": {
                    "Variable": "j"
                  },
                  "span": {
                    "start": 22,
                    "end": 24,
                    "start_line": 6,
                    "start_col": 0
                  }
                },
                "op": "Assign",
                "value": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 27,
                    "end": 28,
                    "start_line": 6,
                    "start_col": 5
                  }
                }
              }
            },
            "span": {
              "start": 22,
              "end": 28,
              "start_line": 6,
              "start_col": 0
            }
          },
          "body": {
            "kind": "Nop",
            "span": {
              "start": 28,
              "end": 29,
              "start_line": 6,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 15,
        "end": 29,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "k"
                },
                "span": {
                  "start": 30,
                  "end": 32,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 35,
                  "end": 36,
                  "start_line": 7,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 36,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 37,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}
