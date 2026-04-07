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
                              "end": 8
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 10,
                              "end": 11
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 13
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 14,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "method": {
                "kind": {
                  "Identifier": "c"
                },
                "span": {
                  "start": 18,
                  "end": 19
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
