===source===
<?php function gen() { yield 'a' => 1; yield 'b' => 2; }
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
                      "key": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 29,
                          "end": 32,
                          "start_line": 1,
                          "start_col": 29
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 36,
                          "end": 37,
                          "start_line": 1,
                          "start_col": 36
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 37,
                    "start_line": 1,
                    "start_col": 23
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 39,
                "start_line": 1,
                "start_col": 23
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": {
                        "kind": {
                          "String": "b"
                        },
                        "span": {
                          "start": 45,
                          "end": 48,
                          "start_line": 1,
                          "start_col": 45
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 52,
                          "end": 53,
                          "start_line": 1,
                          "start_col": 52
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 39,
                    "end": 53,
                    "start_line": 1,
                    "start_col": 39
                  }
                }
              },
              "span": {
                "start": 39,
                "end": 55,
                "start_line": 1,
                "start_col": 39
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
