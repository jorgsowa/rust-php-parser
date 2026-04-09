===source===
<?php func(a: 1, ...['b' => 2]);
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
                  "Identifier": "func"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": "a",
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
                    "start": 11,
                    "end": 15,
                    "start_line": 1,
                    "start_col": 11
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 21,
                              "end": 24,
                              "start_line": 1,
                              "start_col": 21
                            }
                          },
                          "value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 28,
                              "end": 29,
                              "start_line": 1,
                              "start_col": 28
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 21,
                            "end": 29,
                            "start_line": 1,
                            "start_col": 21
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 20,
                      "end": 30,
                      "start_line": 1,
                      "start_col": 20
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 17,
                    "end": 30,
                    "start_line": 1,
                    "start_col": 17
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 31,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32,
    "start_line": 1,
    "start_col": 0
  }
}
