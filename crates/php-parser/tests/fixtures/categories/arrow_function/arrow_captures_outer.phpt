===source===
<?php $mult = fn($x) => $x * $factor;
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
                  "Variable": "mult"
                },
                "span": {
                  "start": 6,
                  "end": 11,
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
                          "start": 17,
                          "end": 19,
                          "start_line": 1,
                          "start_col": 17
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
                              "start": 24,
                              "end": 26,
                              "start_line": 1,
                              "start_col": 24
                            }
                          },
                          "op": "Mul",
                          "right": {
                            "kind": {
                              "Variable": "factor"
                            },
                            "span": {
                              "start": 29,
                              "end": 36,
                              "start_line": 1,
                              "start_col": 29
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 36,
                        "start_line": 1,
                        "start_col": 24
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 14,
                  "end": 36,
                  "start_line": 1,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}
