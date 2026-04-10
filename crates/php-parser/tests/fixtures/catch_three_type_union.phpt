===source===
<?php
try {
    risky();
} catch (A|B|C $e) {
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
                "end": 24
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 34,
                    "end": 35
                  }
                },
                {
                  "parts": [
                    "B"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 36,
                    "end": 37
                  }
                },
                {
                  "parts": [
                    "C"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 38,
                    "end": 39
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
                              "start": 50,
                              "end": 56
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
                                  "start": 57,
                                  "end": 59
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 57,
                                "end": 59
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 60
                      }
                    }
                  },
                  "span": {
                    "start": 50,
                    "end": 61
                  }
                }
              ],
              "span": {
                "start": 33,
                "end": 63
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
