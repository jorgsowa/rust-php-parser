===source===
<?php
function g() {
    yield from $a or $b;
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
                                "start": 36,
                                "end": 38
                              }
                            },
                            "is_from": true
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 38
                        }
                      },
                      "op": "LogicalOr",
                      "right": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 42,
                          "end": 44
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 44
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 45
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
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
