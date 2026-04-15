===source===
<?php $a ?? $b ?? $c = $d;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "right": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "right": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 18,
                              "end": 20
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Variable": "d"
                            },
                            "span": {
                              "start": 23,
                              "end": 25
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 25
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
