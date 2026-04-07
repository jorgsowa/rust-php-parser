===source===
<?php $fn = function(int $x): string { return (string)$x; };
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
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": "x",
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 21,
                                "end": 24
                              }
                            }
                          },
                          "span": {
                            "start": 21,
                            "end": 24
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "is_readonly": false,
                        "is_final": false,
                        "visibility": null,
                        "set_visibility": null,
                        "attributes": [],
                        "span": {
                          "start": 21,
                          "end": 27
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 30,
                            "end": 36
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 36
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Cast": [
                                "String",
                                {
                                  "kind": {
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 54,
                                    "end": 56
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 46,
                              "end": 56
                            }
                          }
                        },
                        "span": {
                          "start": 39,
                          "end": 58
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 59
          }
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
