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
                        "end": 52
                      }
                    }
                  },
                  "span": {
                    "start": 44,
                    "end": 54
                  }
                }
              ],
              "span": {
                "start": 27,
                "end": 55
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
