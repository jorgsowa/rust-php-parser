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
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 34,
                    "end": 35,
                    "start_line": 4,
                    "start_col": 9
                  }
                },
                {
                  "parts": [
                    "B"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 36,
                    "end": 37,
                    "start_line": 4,
                    "start_col": 11
                  }
                },
                {
                  "parts": [
                    "C"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 38,
                    "end": 40,
                    "start_line": 4,
                    "start_col": 13
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
                              "end": 56,
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
                                  "start": 57,
                                  "end": 59,
                                  "start_line": 5,
                                  "start_col": 11
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 57,
                                "end": 59,
                                "start_line": 5,
                                "start_col": 11
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 60,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 50,
                    "end": 62,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 33,
                "end": 63,
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
        "end": 63,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
