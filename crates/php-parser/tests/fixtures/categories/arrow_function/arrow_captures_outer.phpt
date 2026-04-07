===source===
<?php $mult = fn($x) => $x * $factor;
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
                  "Variable": "mult"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
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
                          "start": 17,
                          "end": 19
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
                              "start": 24,
                              "end": 26
                            }
                          },
                          "op": "Mul",
                          "right": {
                            "kind": {
                              "Variable": "factor"
                            },
                            "span": {
                              "start": 29,
                              "end": 36
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 36
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 14,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
