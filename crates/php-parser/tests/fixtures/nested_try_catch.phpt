===source===
<?php
try {
    try {
        dangerousOp();
    } catch (InnerException $e) {
        log($e);
        throw $e;
    }
} catch (OuterException $e) {
    handleOuter($e);
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
                "TryCatch": {
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Identifier": "dangerousOp"
                                },
                                "span": {
                                  "start": 30,
                                  "end": 41,
                                  "start_line": 4,
                                  "start_col": 8
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 43,
                            "start_line": 4,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 49,
                        "start_line": 4,
                        "start_col": 8
                      }
                    }
                  ],
                  "catches": [
                    {
                      "types": [
                        {
                          "parts": [
                            "InnerException"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 58,
                            "end": 73,
                            "start_line": 5,
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
                                      "Identifier": "log"
                                    },
                                    "span": {
                                      "start": 87,
                                      "end": 90,
                                      "start_line": 6,
                                      "start_col": 8
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
                                          "start_line": 6,
                                          "start_col": 12
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 91,
                                        "end": 93,
                                        "start_line": 6,
                                        "start_col": 12
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 87,
                                "end": 94,
                                "start_line": 6,
                                "start_col": 8
                              }
                            }
                          },
                          "span": {
                            "start": 87,
                            "end": 104,
                            "start_line": 6,
                            "start_col": 8
                          }
                        },
                        {
                          "kind": {
                            "Throw": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 110,
                                "end": 112,
                                "start_line": 7,
                                "start_col": 14
                              }
                            }
                          },
                          "span": {
                            "start": 104,
                            "end": 118,
                            "start_line": 7,
                            "start_col": 8
                          }
                        }
                      ],
                      "span": {
                        "start": 57,
                        "end": 120,
                        "start_line": 5,
                        "start_col": 12
                      }
                    }
                  ],
                  "finally": null
                }
              },
              "span": {
                "start": 16,
                "end": 120,
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
                    "OuterException"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 129,
                    "end": 144,
                    "start_line": 9,
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
                              "Identifier": "handleOuter"
                            },
                            "span": {
                              "start": 154,
                              "end": 165,
                              "start_line": 10,
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
                                  "start": 166,
                                  "end": 168,
                                  "start_line": 10,
                                  "start_col": 16
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 166,
                                "end": 168,
                                "start_line": 10,
                                "start_col": 16
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 154,
                        "end": 169,
                        "start_line": 10,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 154,
                    "end": 171,
                    "start_line": 10,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 128,
                "end": 172,
                "start_line": 9,
                "start_col": 8
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 172,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 172,
    "start_line": 1,
    "start_col": 0
  }
}
