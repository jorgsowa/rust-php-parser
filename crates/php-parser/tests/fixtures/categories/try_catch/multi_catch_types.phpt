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
                "end": 19
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
                          "end": 64
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 57,
                    "end": 66
                  }
                }
              ],
              "span": {
                "start": 27,
                "end": 67
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
