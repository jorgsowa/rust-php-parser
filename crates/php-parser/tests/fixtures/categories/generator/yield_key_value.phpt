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
                          "end": 32
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 36,
                          "end": 37
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 37
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 38
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
                          "end": 48
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 52,
                          "end": 53
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 39,
                    "end": 53
                  }
                }
              },
              "span": {
                "start": 39,
                "end": 54
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
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
