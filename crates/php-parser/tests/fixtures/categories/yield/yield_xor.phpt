===source===
<?php
function g() {
    yield $a xor $b;
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
                                "Variable": "a"
                              },
                              "span": {
                                "start": 31,
                                "end": 33
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 33
                        }
                      },
                      "op": "LogicalXor",
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
                    "start": 25,
                    "end": 40
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 41
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
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
