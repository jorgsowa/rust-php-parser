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
          "catches": [],
          "finally": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "cleanup"
                        },
                        "span": {
                          "start": 31,
                          "end": 38,
                          "start_line": 1,
                          "start_col": 31
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 31,
                    "end": 40,
                    "start_line": 1,
                    "start_col": 31
                  }
                }
              },
              "span": {
                "start": 31,
                "end": 42,
                "start_line": 1,
                "start_col": 31
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 43,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}
