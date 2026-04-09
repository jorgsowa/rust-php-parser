===source===
<?php
function indexedGen() {
    yield 'a' => 1;
    yield 'b' => 2;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "indexedGen",
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
                          "start": 40,
                          "end": 43,
                          "start_line": 3,
                          "start_col": 10
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 47,
                          "end": 48,
                          "start_line": 3,
                          "start_col": 17
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 34,
                    "end": 48,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 34,
                "end": 54,
                "start_line": 3,
                "start_col": 4
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
                          "start": 60,
                          "end": 63,
                          "start_line": 4,
                          "start_col": 10
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 67,
                          "end": 68,
                          "start_line": 4,
                          "start_col": 17
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 54,
                    "end": 68,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 54,
                "end": 70,
                "start_line": 4,
                "start_col": 4
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
        "end": 71,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71,
    "start_line": 1,
    "start_col": 0
  }
}
