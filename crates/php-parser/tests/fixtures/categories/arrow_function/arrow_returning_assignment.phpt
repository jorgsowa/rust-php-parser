===source===
<?php $f = fn() => $x = 1;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 19,
                              "end": 21
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 25
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
