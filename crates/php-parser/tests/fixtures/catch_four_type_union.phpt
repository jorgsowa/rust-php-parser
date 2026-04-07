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
                          "end": 21
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 23
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 25
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
                    "end": 43
                  }
                },
                {
                  "parts": [
                    "ValueError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 44,
                    "end": 54
                  }
                },
                {
                  "parts": [
                    "RuntimeException"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 55,
                    "end": 71
                  }
                },
                {
                  "parts": [
                    "LogicException"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 72,
                    "end": 87
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
                              "end": 103
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
                                  "end": 106
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 104,
                                "end": 106
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 97,
                        "end": 107
                      }
                    }
                  },
                  "span": {
                    "start": 97,
                    "end": 109
                  }
                }
              ],
              "span": {
                "start": 33,
                "end": 110
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 110
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 110
  }
}
