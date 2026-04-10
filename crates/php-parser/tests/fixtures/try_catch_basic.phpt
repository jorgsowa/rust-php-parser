===source===
<?php
try {
    $x = riskyOperation();
} catch (Exception $e) {
    echo $e;
} finally {
    cleanup();
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
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 16,
                          "end": 18
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "riskyOperation"
                              },
                              "span": {
                                "start": 21,
                                "end": 35
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 37
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 37
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 38
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Exception"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 48,
                    "end": 57
                  }
                }
              ],
              "var": "e",
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "e"
                        },
                        "span": {
                          "start": 73,
                          "end": 75
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 68,
                    "end": 76
                  }
                }
              ],
              "span": {
                "start": 47,
                "end": 78
              }
            }
          ],
          "finally": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "cleanup"
                        },
                        "span": {
                          "start": 93,
                          "end": 100
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 93,
                    "end": 102
                  }
                }
              },
              "span": {
                "start": 93,
                "end": 103
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 105
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105
  }
}
