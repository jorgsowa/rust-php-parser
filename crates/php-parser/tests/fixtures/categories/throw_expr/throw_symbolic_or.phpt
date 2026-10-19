===source===
<?php
$x = $a ?? throw $e || 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "right": {
                      "kind": {
                        "Throw": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "e"
                                },
                                "span": {
                                  "start": 23,
                                  "end": 25
                                }
                              },
                              "op": "BooleanOr",
                              "right": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 29,
                                  "end": 30
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 23,
                            "end": 30
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 30
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
