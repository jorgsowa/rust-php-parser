===description===
PHP: "a" . (1 << 3) . "b".
===source===
<?php
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
                        "start": 6,
                        "end": 9
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
                              "start": 12,
                              "end": 13
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 21,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
