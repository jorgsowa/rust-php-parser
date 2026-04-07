===source===
<?php $a == $b && $b == $c;
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
                        "end": 8
                      }
                    },
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
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
                        "start": 18,
                        "end": 20
                      }
                    },
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 24,
                        "end": 26
                      }
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
