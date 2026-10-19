===config===
min_php=8.6
===source===
<?php $fn = $obj->method(?, 2);
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
                  "Variable": "fn"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 12,
                        "end": 16
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method"
                      },
                      "span": {
                        "start": 18,
                        "end": 24
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": "Placeholder",
                        "span": {
                          "start": 25,
                          "end": 26
                        }
                      },
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 28,
                              "end": 29
                            }
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 29
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
