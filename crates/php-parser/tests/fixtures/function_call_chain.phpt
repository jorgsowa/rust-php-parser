===source===
<?php foo(bar(1), 2);
===ast===
{
  "stmts": [
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
                  "start": 6,
                  "end": 9,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Identifier": "bar"
                          },
                          "span": {
                            "start": 10,
                            "end": 13,
                            "start_line": 1,
                            "start_col": 10
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 14,
                                "end": 15,
                                "start_line": 1,
                                "start_col": 14
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 14,
                              "end": 15,
                              "start_line": 1,
                              "start_col": 14
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 10,
                      "end": 16,
                      "start_line": 1,
                      "start_col": 10
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 16,
                    "start_line": 1,
                    "start_col": 10
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 18,
                      "end": 19,
                      "start_line": 1,
                      "start_col": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 18,
                    "end": 19,
                    "start_line": 1,
                    "start_col": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21,
    "start_line": 1,
    "start_col": 0
  }
}
