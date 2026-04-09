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
                  "end": 9,
                  "start_line": 1,
                  "start_col": 6
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
                          "end": 17,
                          "start_line": 1,
                          "start_col": 15
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "value": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 23,
                                "end": 25,
                                "start_line": 1,
                                "start_col": 23
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 23,
                              "end": 25,
                              "start_line": 1,
                              "start_col": 23
                            }
                          },
                          {
                            "key": null,
                            "value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Variable": "x"
                                    },
                                    "span": {
                                      "start": 27,
                                      "end": 29,
                                      "start_line": 1,
                                      "start_col": 27
                                    }
                                  },
                                  "op": "Mul",
                                  "right": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 32,
                                      "end": 33,
                                      "start_line": 1,
                                      "start_col": 32
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 27,
                                "end": 33,
                                "start_line": 1,
                                "start_col": 27
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 27,
                              "end": 33,
                              "start_line": 1,
                              "start_col": 27
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 22,
                        "end": 34,
                        "start_line": 1,
                        "start_col": 22
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
