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
                  "end": 21,
                  "start_line": 1,
                  "start_col": 20
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
                              "end": 28,
                              "start_line": 1,
                              "start_col": 25
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 30,
                        "start_line": 1,
                        "start_col": 25
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 32,
                    "start_line": 1,
                    "start_col": 25
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
                              "end": 35,
                              "start_line": 1,
                              "start_col": 32
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 37,
                        "start_line": 1,
                        "start_col": 32
                      }
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 39,
                    "start_line": 1,
                    "start_col": 32
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 40,
              "start_line": 1,
              "start_col": 23
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40,
    "start_line": 1,
    "start_col": 0
  }
}
