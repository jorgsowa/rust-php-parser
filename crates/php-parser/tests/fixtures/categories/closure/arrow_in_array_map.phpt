===source===
<?php array_map(fn($x) => $x * 2, $arr);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "array_map"
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "args": [
                {
                  "name": null,
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
                              "start": 19,
                              "end": 21
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
                                  "start": 26,
                                  "end": 28
                                }
                              },
                              "op": "Mul",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 31,
                                  "end": 32
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 26,
                            "end": 32
                          }
                        },
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 32
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 32
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "arr"
                    },
                    "span": {
                      "start": 34,
                      "end": 38
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 34,
                    "end": 38
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
