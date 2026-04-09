===source===
<?php
function combined() {
    yield from [1, 2, 3];
    yield from otherGenerator();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "combined",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 44,
                                  "end": 45,
                                  "start_line": 3,
                                  "start_col": 16
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 44,
                                "end": 45,
                                "start_line": 3,
                                "start_col": 16
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 47,
                                  "end": 48,
                                  "start_line": 3,
                                  "start_col": 19
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 47,
                                "end": 48,
                                "start_line": 3,
                                "start_col": 19
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 3
                                },
                                "span": {
                                  "start": 50,
                                  "end": 51,
                                  "start_line": 3,
                                  "start_col": 22
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 50,
                                "end": 51,
                                "start_line": 3,
                                "start_col": 22
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 43,
                          "end": 52,
                          "start_line": 3,
                          "start_col": 15
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 52,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 58,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "otherGenerator"
                              },
                              "span": {
                                "start": 69,
                                "end": 83,
                                "start_line": 4,
                                "start_col": 15
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 85,
                          "start_line": 4,
                          "start_col": 15
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 85,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 58,
                "end": 87,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 88,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88,
    "start_line": 1,
    "start_col": 0
  }
}
