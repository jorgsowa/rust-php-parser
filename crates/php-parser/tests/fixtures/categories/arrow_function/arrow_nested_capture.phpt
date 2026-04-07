===source===
<?php $fn = fn($x) => fn($y) => $x * $y * $base;
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
                          "start": 15,
                          "end": 17
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "ArrowFunction": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": "y",
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
                                "start": 25,
                                "end": 27
                              }
                            }
                          ],
                          "return_type": null,
                          "body": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Variable": "x"
                                        },
                                        "span": {
                                          "start": 32,
                                          "end": 34
                                        }
                                      },
                                      "op": "Mul",
                                      "right": {
                                        "kind": {
                                          "Variable": "y"
                                        },
                                        "span": {
                                          "start": 37,
                                          "end": 39
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 32,
                                    "end": 39
                                  }
                                },
                                "op": "Mul",
                                "right": {
                                  "kind": {
                                    "Variable": "base"
                                  },
                                  "span": {
                                    "start": 42,
                                    "end": 47
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 32,
                              "end": 47
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 47
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 47
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
