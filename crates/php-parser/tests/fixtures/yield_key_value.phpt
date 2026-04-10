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
                          "end": 43
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 47,
                          "end": 48
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 34,
                    "end": 48
                  }
                }
              },
              "span": {
                "start": 34,
                "end": 49
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
                          "end": 63
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 67,
                          "end": 68
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 54,
                    "end": 68
                  }
                }
              },
              "span": {
                "start": 54,
                "end": 69
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
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
