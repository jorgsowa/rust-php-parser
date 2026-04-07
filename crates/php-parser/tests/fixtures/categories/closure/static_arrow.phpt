===source===
<?php $fn = static fn($x) => $x * 2;
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
                  "ArrowFunction": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [
                      {
                        "name": "x",
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 22,
                          "end": 24
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 29,
                              "end": 31
                            }
                          },
                          "op": "Mul",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 34,
                              "end": 35
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 35
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
