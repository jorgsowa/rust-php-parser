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
                        "end": 8
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 23
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
                        "end": 29
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Bar"
                      },
                      "span": {
                        "start": 41,
                        "end": 44
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 44
          }
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
