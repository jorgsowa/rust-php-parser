===source===
<?php
function g() {
    yield ($a or $b);
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 15,
              "end": 16
            }
          },
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
                          "Parenthesized": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 32,
                                    "end": 34
                                  }
                                },
                                "op": "LogicalOr",
                                "right": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 38,
                                    "end": 40
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 32,
                              "end": 40
                            }
                          }
                        },
                        "span": {
                          "start": 31,
                          "end": 41
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 41
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 42
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
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
