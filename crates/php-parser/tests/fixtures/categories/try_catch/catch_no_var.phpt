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
                    "end": 55
                  }
                }
              ],
              "span": {
                "start": 27,
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
