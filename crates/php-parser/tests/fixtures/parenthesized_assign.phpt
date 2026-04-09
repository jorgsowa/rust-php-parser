===source===
<?php ($x = getValue())->process();
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
                  "Parenthesized": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 7,
                            "end": 9,
                            "start_line": 1,
                            "start_col": 7
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Identifier": "getValue"
                                },
                                "span": {
                                  "start": 12,
                                  "end": 20,
                                  "start_line": 1,
                                  "start_col": 12
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 12,
                            "end": 22,
                            "start_line": 1,
                            "start_col": 12
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 22,
                      "start_line": 1,
                      "start_col": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "process"
                },
                "span": {
                  "start": 25,
                  "end": 32,
                  "start_line": 1,
                  "start_col": 25
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 34,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
