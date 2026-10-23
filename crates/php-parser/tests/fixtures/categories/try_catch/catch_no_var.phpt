===source===
<?php try { foo(); } catch (Exception) { echo 'error'; }
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
                    "Exception"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 28,
                    "end": 37
                  }
                }
              ],
              "var": null,
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "error"
                        },
                        "span": {
                          "start": 46,
                          "end": 53
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 41,
                    "end": 54
                  }
                }
              ],
              "span": {
                "start": 21,
                "end": 56
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
