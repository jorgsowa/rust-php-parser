===source===
<?php
// PHP: "a" . (1 << 3) . "b".
"a" . 1 << 3 . "b";
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
                        "String": "a"
                      },
                      "span": {
                        "start": 36,
                        "end": 39
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 42,
                              "end": 43
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 47,
                              "end": 48
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 42,
                        "end": 48
                      }
                    }
                  }
                },
                "span": {
                  "start": 36,
                  "end": 48
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 51,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 54
          }
        }
      },
      "span": {
        "start": 36,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
