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
                    "method": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 15,
                        "end": 16
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "method": {
                "kind": {
                  "Identifier": "d"
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
