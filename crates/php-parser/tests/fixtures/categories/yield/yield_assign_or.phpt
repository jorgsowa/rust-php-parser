===source===
<?php
function g() {
    yield $x = 1 or $b;
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
                    "Binary": {
                      "left": {
                        "kind": {
                          "Yield": {
                            "key": null,
                            "value": {
                              "kind": {
                                "Assign": {
                                  "target": {
                                    "kind": {
                                      "Variable": "x"
                                    },
                                    "span": {
                                      "start": 31,
                                      "end": 33
                                    }
                                  },
                                  "op": "Assign",
                                  "value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 36,
                                      "end": 37
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 31,
                                "end": 37
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 37
                        }
                      },
                      "op": "LogicalOr",
                      "right": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 41,
                          "end": 43
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 43
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 44
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
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
