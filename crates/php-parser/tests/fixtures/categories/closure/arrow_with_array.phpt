===source===
<?php $fn = fn($x) => [$x, $x * 2];
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
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 15,
                            "end": 17
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 15,
                          "end": 17
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 23,
                                  "end": 25
                                }
                              }
                            },
                            "span": {
                              "start": 23,
                              "end": 25
                            }
                          },
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "Variable": "x"
                                      },
                                      "span": {
                                        "start": 27,
                                        "end": 29
                                      }
                                    },
                                    "op": "Mul",
                                    "right": {
                                      "kind": {
                                        "Int": 2
                                      },
                                      "span": {
                                        "start": 32,
                                        "end": 33
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 27,
                                  "end": 33
                                }
                              }
                            },
                            "span": {
                              "start": 27,
                              "end": 33
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 22,
                        "end": 34
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
