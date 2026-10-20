===description===
`$a instanceof Foo && $b instanceof Bar` parses as `($a instanceof Foo) && ($b instanceof Bar)`.
===source===
<?php
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
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 20,
                            "end": 23
                          }
                        }
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
                        "Name": {
                          "parts": [
                            "Bar"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 41,
                            "end": 44
                          }
                        }
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
