===source===
<?php
if ($x > 1 {
    echo "hello";
}
===errors===
expected expression
expected '}', found 'echo'
unclosed '')'' opened at 2:3
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 10,
                    "end": 12,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                "op": "Greater",
                "right": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 15,
                          "end": 16,
                          "start_line": 2,
                          "start_col": 9
                        }
                      },
                      "index": {
                        "kind": "Error",
                        "span": {
                          "start": 23,
                          "end": 27,
                          "start_line": 3,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 15,
                    "end": 23,
                    "start_line": 2,
                    "start_col": 9
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 23,
              "start_line": 2,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Echo": [
                {
                  "kind": {
                    "String": "hello"
                  },
                  "span": {
                    "start": 28,
                    "end": 35,
                    "start_line": 3,
                    "start_col": 9
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 37,
              "start_line": 3,
              "start_col": 4
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 37,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 37,
        "end": 37,
        "start_line": 4,
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
