===source===
<?php
function generate() {
    yield 1;
    yield 2;
    yield 3;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "generate",
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
                          "start": 38,
                          "end": 39,
                          "start_line": 3,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 39,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 45,
                "start_line": 3,
                "start_col": 4
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
                          "start": 51,
                          "end": 52,
                          "start_line": 4,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 45,
                    "end": 52,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 45,
                "end": 58,
                "start_line": 4,
                "start_col": 4
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
                          "Int": 3
                        },
                        "span": {
                          "start": 64,
                          "end": 65,
                          "start_line": 5,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 65,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 58,
                "end": 67,
                "start_line": 5,
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
        "end": 68,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68,
    "start_line": 1,
    "start_col": 0
  }
}
