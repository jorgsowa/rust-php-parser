===source===
<?php $fn = fn($x): Closure => fn($y): int => $x + $y;
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
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Closure"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 20,
                            "end": 28
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 28
                      }
                    },
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
                                "start": 34,
                                "end": 36
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
                                  "start": 39,
                                  "end": 42
                                }
                              }
                            },
                            "span": {
                              "start": 39,
                              "end": 42
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
                                    "start": 46,
                                    "end": 48
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 51,
                                    "end": 53
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 46,
                              "end": 53
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 53
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 53
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 53
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
