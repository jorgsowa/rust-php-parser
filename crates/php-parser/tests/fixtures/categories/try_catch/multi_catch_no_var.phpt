===source===
<?php try { foo(); } catch (TypeError | ValueError) { log(); }
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
                          "start": 12,
                          "end": 15,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 17,
                    "start_line": 1,
                    "start_col": 12
                  }
                }
              },
              "span": {
                "start": 12,
                "end": 19,
                "start_line": 1,
                "start_col": 12
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
                    "start": 28,
                    "end": 38,
                    "start_line": 1,
                    "start_col": 28
                  }
                },
                {
                  "parts": [
                    "ValueError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 40,
                    "end": 50,
                    "start_line": 1,
                    "start_col": 40
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
                              "Identifier": "log"
                            },
                            "span": {
                              "start": 54,
                              "end": 57,
                              "start_line": 1,
                              "start_col": 54
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 54,
                        "end": 59,
                        "start_line": 1,
                        "start_col": 54
                      }
                    }
                  },
                  "span": {
                    "start": 54,
                    "end": 61,
                    "start_line": 1,
                    "start_col": 54
                  }
                }
              ],
              "span": {
                "start": 27,
                "end": 62,
                "start_line": 1,
                "start_col": 27
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 62,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62,
    "start_line": 1,
    "start_col": 0
  }
}
