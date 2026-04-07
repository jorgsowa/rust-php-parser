===source===
<?php $a ?? $b ?? $c ?? 'default';
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
                        "NullCoalesce": {
                          "left": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 18,
                              "end": 20
                            }
                          },
                          "right": {
                            "kind": {
                              "String": "default"
                            },
                            "span": {
                              "start": 24,
                              "end": 33
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 33
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
