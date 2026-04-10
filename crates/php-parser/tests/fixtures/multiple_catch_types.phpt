===source===
<?php
try {
    foo();
} catch (TypeError | ValueError | RuntimeException $e) {
    handle($e);
} catch (LogicException $e) {
    other($e);
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
                          "Identifier": "foo"
                        },
                        "span": {
                          "start": 16,
                          "end": 19
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 21
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 22
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
                    "start": 32,
                    "end": 41
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
                    "start": 57,
                    "end": 73
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
                              "start": 84,
                              "end": 90
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
                                  "start": 91,
                                  "end": 93
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 91,
                                "end": 93
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 84,
                        "end": 94
                      }
                    }
                  },
                  "span": {
                    "start": 84,
                    "end": 95
                  }
                }
              ],
              "span": {
                "start": 31,
                "end": 97
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "LogicException"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 105,
                    "end": 119
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
                              "Identifier": "other"
                            },
                            "span": {
                              "start": 130,
                              "end": 135
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
                                  "start": 136,
                                  "end": 138
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 136,
                                "end": 138
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 130,
                        "end": 139
                      }
                    }
                  },
                  "span": {
                    "start": 130,
                    "end": 140
                  }
                }
              ],
              "span": {
                "start": 104,
                "end": 142
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 142
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 142
  }
}
