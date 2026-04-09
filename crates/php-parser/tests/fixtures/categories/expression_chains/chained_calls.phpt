===source===
<?php $a->b()->c()->d();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
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
                          "method": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 10,
                              "end": 11,
                              "start_line": 1,
                              "start_col": 10
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 13,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 15,
                        "end": 16,
                        "start_line": 1,
                        "start_col": 15
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "d"
                },
                "span": {
                  "start": 20,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 20
                }
              },
              "args": []
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
