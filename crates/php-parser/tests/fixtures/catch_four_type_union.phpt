===source===
<?php
try {
    risky();
} catch (TypeError|ValueError|RuntimeException|LogicException $e) {
    handle($e);
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "risky"
                        },
                        "span": {
                          "start": 16,
                          "end": 21,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 23,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 25,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "TypeError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 34,
                    "end": 43,
                    "start_line": 4,
                    "start_col": 9
                  }
                },
                {
                  "parts": [
                    "ValueError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 44,
                    "end": 54,
                    "start_line": 4,
                    "start_col": 19
                  }
                },
                {
                  "parts": [
                    "RuntimeException"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 55,
                    "end": 71,
                    "start_line": 4,
                    "start_col": 30
                  }
                },
                {
                  "parts": [
                    "LogicException"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 72,
                    "end": 87,
                    "start_line": 4,
                    "start_col": 47
                  }
                }
              ],
              "var": "e",
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "handle"
                            },
                            "span": {
                              "start": 97,
                              "end": 103,
                              "start_line": 5,
                              "start_col": 4
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "value": {
                                "kind": {
                                  "Variable": "e"
                                },
                                "span": {
                                  "start": 104,
                                  "end": 106,
                                  "start_line": 5,
                                  "start_col": 11
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 104,
                                "end": 106,
                                "start_line": 5,
                                "start_col": 11
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 107,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 97,
                    "end": 109,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 33,
                "end": 110,
                "start_line": 4,
                "start_col": 8
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 110,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 110,
    "start_line": 1,
    "start_col": 0
  }
}
