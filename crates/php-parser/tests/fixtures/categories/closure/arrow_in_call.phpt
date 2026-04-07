===source===
<?php array_filter($arr, fn($x) => $x > 0);
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
                  "Identifier": "array_filter"
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "arr"
                    },
                    "span": {
                      "start": 19,
                      "end": 23
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 19,
                    "end": 23
                  }
                },
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
                              "start": 28,
                              "end": 30
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
                                  "start": 35,
                                  "end": 37
                                }
                              },
                              "op": "Greater",
                              "right": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 40,
                                  "end": 41
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 35,
                            "end": 41
                          }
                        },
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 25,
                      "end": 41
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 25,
                    "end": 41
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
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
