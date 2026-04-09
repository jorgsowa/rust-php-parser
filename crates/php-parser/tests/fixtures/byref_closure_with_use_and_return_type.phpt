===source===
<?php $f = function &($x) use (&$ref): string { return $ref; };
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": true,
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
                          "start": 22,
                          "end": 24,
                          "start_line": 1,
                          "start_col": 22
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": "ref",
                        "by_ref": true,
                        "span": {
                          "start": 31,
                          "end": 36,
                          "start_line": 1,
                          "start_col": 31
                        }
                      }
                    ],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 39,
                            "end": 45,
                            "start_line": 1,
                            "start_col": 39
                          }
                        }
                      },
                      "span": {
                        "start": 39,
                        "end": 45,
                        "start_line": 1,
                        "start_col": 39
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Variable": "ref"
                            },
                            "span": {
                              "start": 55,
                              "end": 59,
                              "start_line": 1,
                              "start_col": 55
                            }
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 61,
                          "start_line": 1,
                          "start_col": 48
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 62,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 62,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 63,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
