===source===
<?php try { foo(); } catch (TypeError | ValueError) { log(); }
===errors <=7.4===
'non-capturing catch' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting '|' or variable (T_VARIABLE) in Standard input code on line 1
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
                              "foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 12,
                              "end": 15
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 15
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 17
                  }
                }
              },
              "span": {
                "start": 12,
                "end": 18
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
                    "end": 37
                  }
                },
                {
                  "parts": [
                    "ValueError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 40,
                    "end": 50
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
                                  "log"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 54,
                                  "end": 57
                                }
                              }
                            },
                            "span": {
                              "start": 54,
                              "end": 57
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 54,
                        "end": 59
                      }
                    }
                  },
                  "span": {
                    "start": 54,
                    "end": 60
                  }
                }
              ],
              "span": {
                "start": 27,
                "end": 62
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
