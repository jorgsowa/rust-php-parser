===source===
<?php
// PHP: ($a instanceof Foo) && ($b instanceof Bar).
$a instanceof Foo && $b instanceof Bar;
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
                        "start": 58,
                        "end": 60
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 72,
                        "end": 75
                      }
                    }
                  }
                },
                "span": {
                  "start": 58,
                  "end": 75
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
                        "start": 79,
                        "end": 81
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Bar"
                      },
                      "span": {
                        "start": 93,
                        "end": 96
                      }
                    }
                  }
                },
                "span": {
                  "start": 79,
                  "end": 96
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 96
          }
        }
      },
      "span": {
        "start": 58,
        "end": 97
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 97
  }
}
