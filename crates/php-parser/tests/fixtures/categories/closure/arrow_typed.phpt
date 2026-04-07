===source===
<?php $fn = fn(int $x): int => $x * 2;
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
                                "start": 15,
                                "end": 18
                              }
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 18
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
                          "start": 15,
                          "end": 21
                        }
                      }
                    ],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 24,
                            "end": 27
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 27
                      }
                    },
                    "body": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 31,
                              "end": 33
                            }
                          },
                          "op": "Mul",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 36,
                              "end": 37
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 37
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
