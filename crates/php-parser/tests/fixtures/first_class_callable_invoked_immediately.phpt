===source===
<?php $r = (strlen(...))('hello');
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
                  "Variable": "r"
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
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "CallableCreate": {
                              "kind": {
                                "Function": {
                                  "kind": {
                                    "Identifier": "strlen"
                                  },
                                  "span": {
                                    "start": 12,
                                    "end": 18,
                                    "start_line": 1,
                                    "start_col": 12
                                  }
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 12,
                            "end": 23,
                            "start_line": 1,
                            "start_col": 12
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "hello"
                          },
                          "span": {
                            "start": 25,
                            "end": 32,
                            "start_line": 1,
                            "start_col": 25
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 25,
                          "end": 32,
                          "start_line": 1,
                          "start_col": 25
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 11
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
