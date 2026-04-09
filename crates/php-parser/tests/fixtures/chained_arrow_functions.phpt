===source===
<?php $fn = fn($x) => fn($y) => $x + $y;
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
                                "end": 27,
                                "start_line": 1,
                                "start_col": 25
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
                                    "start": 32,
                                    "end": 34,
                                    "start_line": 1,
                                    "start_col": 32
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 37,
                                    "end": 39,
                                    "start_line": 1,
                                    "start_col": 37
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 32,
                              "end": 39,
                              "start_line": 1,
                              "start_col": 32
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 39,
                        "start_line": 1,
                        "start_col": 22
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 39,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40,
    "start_line": 1,
    "start_col": 0
  }
}
