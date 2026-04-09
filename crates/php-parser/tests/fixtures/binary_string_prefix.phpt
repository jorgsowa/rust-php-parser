===source===
<?php
$a = b"binary string";
$b = b'binary single';
$c = B"case insensitive";
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
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "binary string"
                },
                "span": {
                  "start": 11,
                  "end": 27,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29,
        "start_line": 2,
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
                  "Variable": "b"
                },
                "span": {
                  "start": 29,
                  "end": 31,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "binary single"
                },
                "span": {
                  "start": 34,
                  "end": 50,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 29,
            "end": 50,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 29,
        "end": 52,
        "start_line": 3,
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
                  "Variable": "c"
                },
                "span": {
                  "start": 52,
                  "end": 54,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "case insensitive"
                },
                "span": {
                  "start": 57,
                  "end": 76,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 76,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 52,
        "end": 77,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 77,
    "start_line": 1,
    "start_col": 0
  }
}
