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
              "var": {
                "name": "e",
                "span": {
                  "start": 38,
                  "end": 40
                }
              },
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
                    "end": 53
                  }
                }
              ],
              "span": {
                "start": 21,
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
