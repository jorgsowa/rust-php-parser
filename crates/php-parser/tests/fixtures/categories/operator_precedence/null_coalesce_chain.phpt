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
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
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
                        "end": 14,
                        "start_line": 1,
                        "start_col": 12
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
                              "end": 20,
                              "start_line": 1,
                              "start_col": 18
                            }
                          },
                          "right": {
                            "kind": {
                              "String": "default"
                            },
                            "span": {
                              "start": 24,
                              "end": 33,
                              "start_line": 1,
                              "start_col": 24
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 33,
                        "start_line": 1,
                        "start_col": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
