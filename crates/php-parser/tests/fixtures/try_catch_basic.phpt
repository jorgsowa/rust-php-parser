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
                          "end": 18,
                          "start_line": 3,
                          "start_col": 4
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
                                "end": 35,
                                "start_line": 3,
                                "start_col": 9
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 37,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 37,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 39,
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
                    "Exception"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 48,
                    "end": 58,
                    "start_line": 4,
                    "start_col": 9
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
                          "end": 75,
                          "start_line": 5,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 68,
                    "end": 77,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 47,
                "end": 79,
                "start_line": 4,
                "start_col": 8
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
                          "end": 100,
                          "start_line": 7,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 93,
                    "end": 102,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 93,
                "end": 104,
                "start_line": 7,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 105,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105,
    "start_line": 1,
    "start_col": 0
  }
}
