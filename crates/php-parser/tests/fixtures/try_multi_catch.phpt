===source===
<?php
try {
    process();
} catch (TypeError|ValueError $e) {
    handleTypeError($e);
} catch (RuntimeException) {
    handleRuntime();
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
                          "Identifier": "process"
                        },
                        "span": {
                          "start": 16,
                          "end": 23,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 25,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 27,
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
                    "start": 36,
                    "end": 45,
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
                    "start": 46,
                    "end": 57,
                    "start_line": 4,
                    "start_col": 19
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
                              "Identifier": "handleTypeError"
                            },
                            "span": {
                              "start": 67,
                              "end": 82,
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
                                  "start": 83,
                                  "end": 85,
                                  "start_line": 5,
                                  "start_col": 20
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 83,
                                "end": 85,
                                "start_line": 5,
                                "start_col": 20
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 67,
                        "end": 86,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 67,
                    "end": 88,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 35,
                "end": 90,
                "start_line": 4,
                "start_col": 8
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "RuntimeException"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 97,
                    "end": 113,
                    "start_line": 6,
                    "start_col": 9
                  }
                }
              ],
              "var": null,
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "handleRuntime"
                            },
                            "span": {
                              "start": 121,
                              "end": 134,
                              "start_line": 7,
                              "start_col": 4
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 121,
                        "end": 136,
                        "start_line": 7,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 121,
                    "end": 138,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 96,
                "end": 139,
                "start_line": 6,
                "start_col": 8
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 139,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 139,
    "start_line": 1,
    "start_col": 0
  }
}
