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
                  "end": 9,
                  "start_line": 1,
                  "start_col": 6
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
                                "end": 24,
                                "start_line": 1,
                                "start_col": 21
                              }
                            }
                          },
                          "span": {
                            "start": 21,
                            "end": 24,
                            "start_line": 1,
                            "start_col": 21
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
                          "end": 27,
                          "start_line": 1,
                          "start_col": 21
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
                            "end": 36,
                            "start_line": 1,
                            "start_col": 30
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 36,
                        "start_line": 1,
                        "start_col": 30
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
                                    "end": 56,
                                    "start_line": 1,
                                    "start_col": 54
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 46,
                              "end": 56,
                              "start_line": 1,
                              "start_col": 46
                            }
                          }
                        },
                        "span": {
                          "start": 39,
                          "end": 58,
                          "start_line": 1,
                          "start_col": 39
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 59,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 59,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 60,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60,
    "start_line": 1,
    "start_col": 0
  }
}
