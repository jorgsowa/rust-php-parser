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
                          "Name": {
                            "parts": [
                              "process"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 16,
                              "end": 23
                            }
                          }
                        },
                        "span": {
                          "start": 16,
                          "end": 23
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 25
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 26
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
                    "end": 45
                  }
                },
                {
                  "parts": [
                    "ValueError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 46,
                    "end": 56
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 57,
                  "end": 59
                }
              },
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "handleTypeError"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 67,
                                  "end": 82
                                }
                              }
                            },
                            "span": {
                              "start": 67,
                              "end": 82
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "e"
                                  },
                                  "span": {
                                    "start": 83,
                                    "end": 85
                                  }
                                }
                              },
                              "span": {
                                "start": 83,
                                "end": 85
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 67,
                        "end": 86
                      }
                    }
                  },
                  "span": {
                    "start": 67,
                    "end": 87
                  }
                }
              ],
              "span": {
                "start": 35,
                "end": 89
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
                    "end": 113
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
                              "Name": {
                                "parts": [
                                  "handleRuntime"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 121,
                                  "end": 134
                                }
                              }
                            },
                            "span": {
                              "start": 121,
                              "end": 134
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 121,
                        "end": 136
                      }
                    }
                  },
                  "span": {
                    "start": 121,
                    "end": 137
                  }
                }
              ],
              "span": {
                "start": 96,
                "end": 139
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 139
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 139
  }
}
