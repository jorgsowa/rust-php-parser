===source===
<?php
echo "hello"
echo "world";
$x = 1 + 2
===errors===
expected ';' after echo statement
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "hello"
            },
            "span": {
              "start": 11,
              "end": 18,
              "start_line": 2,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "world"
            },
            "span": {
              "start": 24,
              "end": 31,
              "start_line": 3,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 33,
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
                  "Variable": "x"
                },
                "span": {
                  "start": 33,
                  "end": 35,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 38,
                        "end": 39,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 42,
                        "end": 43,
                        "start_line": 4,
                        "start_col": 9
                      }
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 43,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 43,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 33,
        "end": 43,
        "start_line": 4,
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
