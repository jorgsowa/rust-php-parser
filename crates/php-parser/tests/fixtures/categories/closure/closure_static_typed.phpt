===source===
<?php $fn = static function(int $x): int { return $x; };
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
                    "is_static": true,
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
                                "start": 28,
                                "end": 31,
                                "start_line": 1,
                                "start_col": 28
                              }
                            }
                          },
                          "span": {
                            "start": 28,
                            "end": 31,
                            "start_line": 1,
                            "start_col": 28
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
                          "start": 28,
                          "end": 34,
                          "start_line": 1,
                          "start_col": 28
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 37,
                            "end": 40,
                            "start_line": 1,
                            "start_col": 37
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 40,
                        "start_line": 1,
                        "start_col": 37
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 50,
                              "end": 52,
                              "start_line": 1,
                              "start_col": 50
                            }
                          }
                        },
                        "span": {
                          "start": 43,
                          "end": 54,
                          "start_line": 1,
                          "start_col": 43
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 55,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 55,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 56,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56,
    "start_line": 1,
    "start_col": 0
  }
}
