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
                          "end": 19,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 21,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 23,
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
                    "start": 32,
                    "end": 42,
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
                    "end": 55,
                    "start_line": 4,
                    "start_col": 21
                  }
                },
                {
                  "parts": [
                    "RuntimeException"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 57,
                    "end": 74,
                    "start_line": 4,
                    "start_col": 34
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
                              "end": 90,
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
                                  "start": 91,
                                  "end": 93,
                                  "start_line": 5,
                                  "start_col": 11
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 91,
                                "end": 93,
                                "start_line": 5,
                                "start_col": 11
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 84,
                        "end": 94,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 84,
                    "end": 96,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 31,
                "end": 98,
                "start_line": 4,
                "start_col": 8
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
                    "end": 120,
                    "start_line": 6,
                    "start_col": 9
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
                              "end": 135,
                              "start_line": 7,
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
                                  "start": 136,
                                  "end": 138,
                                  "start_line": 7,
                                  "start_col": 10
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 136,
                                "end": 138,
                                "start_line": 7,
                                "start_col": 10
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 130,
                        "end": 139,
                        "start_line": 7,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 130,
                    "end": 141,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 104,
                "end": 142,
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
        "end": 142,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 142,
    "start_line": 1,
    "start_col": 0
  }
}
