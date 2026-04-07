===source===
<?php declare(ticks=1) { foo(); bar(); }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "foo"
                            },
                            "span": {
                              "start": 25,
                              "end": 28
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 32
                  }
                },
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "bar"
                            },
                            "span": {
                              "start": 32,
                              "end": 35
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 37
                      }
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 39
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 40
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
