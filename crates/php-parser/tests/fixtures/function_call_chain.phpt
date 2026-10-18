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
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
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
                            "Name": {
                              "parts": [
                                "bar"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 10,
                                "end": 13
                              }
                            }
                          },
                          "span": {
                            "start": 10,
                            "end": 13
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
                                "end": 15
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 14,
                              "end": 15
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 10,
                      "end": 16
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 16
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
                      "end": 19
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 18,
                    "end": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
