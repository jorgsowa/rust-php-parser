===source===
<?php function gen() { yield 1; yield 2; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 29,
                          "end": 30,
                          "start_line": 1,
                          "start_col": 29
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 30,
                    "start_line": 1,
                    "start_col": 23
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 32,
                "start_line": 1,
                "start_col": 23
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 38,
                          "end": 39,
                          "start_line": 1,
                          "start_col": 38
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 39,
                    "start_line": 1,
                    "start_col": 32
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 41,
                "start_line": 1,
                "start_col": 32
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42,
    "start_line": 1,
    "start_col": 0
  }
}
