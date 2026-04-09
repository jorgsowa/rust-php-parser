===source===
<?php try { foo(); } catch (TypeError | ValueError $e) { echo $e; }
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
                    "end": 51,
                    "start_line": 1,
                    "start_col": 40
                  }
                }
              ],
              "var": "e",
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "e"
                        },
                        "span": {
                          "start": 62,
                          "end": 64,
                          "start_line": 1,
                          "start_col": 62
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 57,
                    "end": 66,
                    "start_line": 1,
                    "start_col": 57
                  }
                }
              ],
              "span": {
                "start": 27,
                "end": 67,
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
        "end": 67,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}
