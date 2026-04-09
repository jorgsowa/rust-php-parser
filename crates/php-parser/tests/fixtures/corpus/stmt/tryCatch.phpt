===source===
<?php

try {
    doTry();
} catch (A $b) {
    doCatchA();
} catch (B $c) {
    doCatchB();
} finally {
    doFinally();
}

// no finally
try { }
catch (A $b) { }

// no catch
try { }
finally { }
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
                          "Identifier": "doTry"
                        },
                        "span": {
                          "start": 17,
                          "end": 22,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 24,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 26,
                "start_line": 4,
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
                    "start": 35,
                    "end": 37,
                    "start_line": 5,
                    "start_col": 9
                  }
                }
              ],
              "var": "b",
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "doCatchA"
                            },
                            "span": {
                              "start": 47,
                              "end": 55,
                              "start_line": 6,
                              "start_col": 4
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 57,
                        "start_line": 6,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 59,
                    "start_line": 6,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 34,
                "end": 61,
                "start_line": 5,
                "start_col": 8
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "B"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 68,
                    "end": 70,
                    "start_line": 7,
                    "start_col": 9
                  }
                }
              ],
              "var": "c",
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "doCatchB"
                            },
                            "span": {
                              "start": 80,
                              "end": 88,
                              "start_line": 8,
                              "start_col": 4
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 80,
                        "end": 90,
                        "start_line": 8,
                        "start_col": 4
                      }
                    }
                  },
                  "span": {
                    "start": 80,
                    "end": 92,
                    "start_line": 8,
                    "start_col": 4
                  }
                }
              ],
              "span": {
                "start": 67,
                "end": 94,
                "start_line": 7,
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
                          "Identifier": "doFinally"
                        },
                        "span": {
                          "start": 108,
                          "end": 117,
                          "start_line": 10,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 108,
                    "end": 119,
                    "start_line": 10,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 108,
                "end": 121,
                "start_line": 10,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 138,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 153,
                    "end": 155,
                    "start_line": 15,
                    "start_col": 7
                  }
                }
              ],
              "var": "b",
              "body": [],
              "span": {
                "start": 152,
                "end": 176,
                "start_line": 15,
                "start_col": 6
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 138,
        "end": 176,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [],
          "finally": []
        }
      },
      "span": {
        "start": 176,
        "end": 195,
        "start_line": 18,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 195,
    "start_line": 1,
    "start_col": 0
  }
}
