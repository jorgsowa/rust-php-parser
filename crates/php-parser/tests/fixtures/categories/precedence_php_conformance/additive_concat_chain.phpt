===description===
PHP: ($a + $b) . ($c + $d). Diagnostic: + above .
===source===
<?php
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
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
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
                        "start": 16,
                        "end": 18
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 21,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
