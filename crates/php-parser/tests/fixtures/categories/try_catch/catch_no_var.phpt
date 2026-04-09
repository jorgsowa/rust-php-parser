===source===
<?php try { foo(); } catch (Exception) { echo 'error'; }
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
                    "Exception"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 28,
                    "end": 37,
                    "start_line": 1,
                    "start_col": 28
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
                          "end": 53,
                          "start_line": 1,
                          "start_col": 46
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 41,
                    "end": 55,
                    "start_line": 1,
                    "start_col": 41
                  }
                }
              ],
              "span": {
                "start": 27,
                "end": 56,
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
        "end": 56,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56,
    "start_line": 1,
    "start_col": 0
  }
}
