===source===
<?php
function g() {
    yield $k => $v or $b;
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
                            "key": {
                              "kind": {
                                "Variable": "k"
                              },
                              "span": {
                                "start": 31,
                                "end": 33
                              }
                            },
                            "value": {
                              "kind": {
                                "Variable": "v"
                              },
                              "span": {
                                "start": 37,
                                "end": 39
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 39
                        }
                      },
                      "op": "LogicalOr",
                      "right": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 43,
                          "end": 45
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 45
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 46
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
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
