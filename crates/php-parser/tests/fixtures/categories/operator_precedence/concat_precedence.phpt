===source===
<?php 'a' . 'b' . $c . 'd';
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
                              "String": "b"
                            },
                            "span": {
                              "start": 12,
                              "end": 15
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 15
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 20
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "d"
                },
                "span": {
                  "start": 23,
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
