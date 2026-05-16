===source===
<?php
// PHP: ($a + $b) . ($c + $d). Diagnostic: + above .
$a + $b . $c + $d;
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
                        "start": 59,
                        "end": 61
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 64,
                        "end": 66
                      }
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 66
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 69,
                        "end": 71
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 74,
                        "end": 76
                      }
                    }
                  }
                },
                "span": {
                  "start": 69,
                  "end": 76
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 76
          }
        }
      },
      "span": {
        "start": 59,
        "end": 77
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 77
  }
}
