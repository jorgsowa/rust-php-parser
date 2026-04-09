===source===
<?php try { foo(); } catch (Exception $e) { throw $e; }
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
                    "end": 38,
                    "start_line": 1,
                    "start_col": 28
                  }
                }
              ],
              "var": "e",
              "body": [
                {
                  "kind": {
                    "Throw": {
                      "kind": {
                        "Variable": "e"
                      },
                      "span": {
                        "start": 50,
                        "end": 52,
                        "start_line": 1,
                        "start_col": 50
                      }
                    }
                  },
                  "span": {
                    "start": 44,
                    "end": 54,
                    "start_line": 1,
                    "start_col": 44
                  }
                }
              ],
              "span": {
                "start": 27,
                "end": 55,
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
        "end": 55,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55,
    "start_line": 1,
    "start_col": 0
  }
}
