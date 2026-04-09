===source===
<?php $a = $b = $c = 42;
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 11,
                        "end": 13,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 16,
                              "end": 18,
                              "start_line": 1,
                              "start_col": 16
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 42
                            },
                            "span": {
                              "start": 21,
                              "end": 23,
                              "start_line": 1,
                              "start_col": 21
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 23,
                        "start_line": 1,
                        "start_col": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
