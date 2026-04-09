===source===
<?php $a->b()[0]->c();
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
                  "ArrayAccess": {
                    "array": {
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
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 14,
                        "end": 15,
                        "start_line": 1,
                        "start_col": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "c"
                },
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 18
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 21,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
