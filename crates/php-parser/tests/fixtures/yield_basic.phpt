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
                          "end": 39
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 39
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 45
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
                          "end": 52
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 45,
                    "end": 52
                  }
                }
              },
              "span": {
                "start": 45,
                "end": 58
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
                          "end": 65
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 65
                  }
                }
              },
              "span": {
                "start": 58,
                "end": 67
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
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
