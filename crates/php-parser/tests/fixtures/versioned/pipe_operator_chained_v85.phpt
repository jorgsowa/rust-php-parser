===config===
min_php=8.5
===source===
<?php $x |> strlen(...) |> abs(...);
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
                        "Variable": "x"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Function": {
                              "kind": {
                                "Identifier": "strlen"
                              },
                              "span": {
                                "start": 12,
                                "end": 18
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
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
              "op": "Pipe",
              "right": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Identifier": "abs"
                        },
                        "span": {
                          "start": 27,
                          "end": 30
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
