===source===
<?php
function g() {
    yield $a || $b;
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
                          "Binary": {
                            "left": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 31,
                                "end": 33
                              }
                            },
                            "op": "BooleanOr",
                            "right": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 37,
                                "end": 39
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 31,
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
                }
              },
              "span": {
                "start": 25,
                "end": 40
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
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
