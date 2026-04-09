===source===
<?php $f = function(int $x, string $y): int { return $x; };
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
                                "start": 20,
                                "end": 23,
                                "start_line": 1,
                                "start_col": 20
                              }
                            }
                          },
                          "span": {
                            "start": 20,
                            "end": 23,
                            "start_line": 1,
                            "start_col": 20
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
                          "start": 20,
                          "end": 26,
                          "start_line": 1,
                          "start_col": 20
                        }
                      },
                      {
                        "name": "y",
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 28,
                                "end": 34,
                                "start_line": 1,
                                "start_col": 28
                              }
                            }
                          },
                          "span": {
                            "start": 28,
                            "end": 34,
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
                          "end": 37,
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
                            "start": 40,
                            "end": 43,
                            "start_line": 1,
                            "start_col": 40
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 43,
                        "start_line": 1,
                        "start_col": 40
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
                              "start": 53,
                              "end": 55,
                              "start_line": 1,
                              "start_col": 53
                            }
                          }
                        },
                        "span": {
                          "start": 46,
                          "end": 57,
                          "start_line": 1,
                          "start_col": 46
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 58,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 58,
            "start_line": 1,
            "start_col": 6
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
  ],
  "span": {
    "start": 0,
    "end": 59,
    "start_line": 1,
    "start_col": 0
  }
}
