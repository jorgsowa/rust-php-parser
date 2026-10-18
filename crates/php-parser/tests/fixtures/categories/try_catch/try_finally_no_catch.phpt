===source===
<?php try { foo(); } finally { cleanup(); }
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
          "catches": [],
          "finally": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "cleanup"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 31,
                              "end": 38
                            }
                          }
                        },
                        "span": {
                          "start": 31,
                          "end": 38
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 31,
                    "end": 40
                  }
                }
              },
              "span": {
                "start": 31,
                "end": 41
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
