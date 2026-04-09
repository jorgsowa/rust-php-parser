===source===
<?php $a instanceof Foo && $b instanceof Bar;
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
                        "Variable": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 8,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 20,
                        "end": 23,
                        "start_line": 1,
                        "start_col": 20
                      }
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
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 27,
                        "end": 29,
                        "start_line": 1,
                        "start_col": 27
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Bar"
                      },
                      "span": {
                        "start": 41,
                        "end": 44,
                        "start_line": 1,
                        "start_col": 41
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 44,
                  "start_line": 1,
                  "start_col": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 44,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 45,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45,
    "start_line": 1,
    "start_col": 0
  }
}
