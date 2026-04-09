===source===
<?php $fn = fn($x) => $x ?? 'default';
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
                        "NullCoalesce": {
                          "left": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 22,
                              "end": 24,
                              "start_line": 1,
                              "start_col": 22
                            }
                          },
                          "right": {
                            "kind": {
                              "String": "default"
                            },
                            "span": {
                              "start": 28,
                              "end": 37,
                              "start_line": 1,
                              "start_col": 28
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 37,
                        "start_line": 1,
                        "start_col": 22
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 37,
                  "start_line": 1,
                  "start_col": 12
                }
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
      },
      "span": {
        "start": 6,
        "end": 38,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
