===source===
<?php $f = function() use ($a, &$b) { return $a + $b; };
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
                    "params": [],
                    "use_vars": [
                      {
                        "name": "a",
                        "by_ref": false,
                        "span": {
                          "start": 27,
                          "end": 29,
                          "start_line": 1,
                          "start_col": 27
                        }
                      },
                      {
                        "name": "b",
                        "by_ref": true,
                        "span": {
                          "start": 31,
                          "end": 34,
                          "start_line": 1,
                          "start_col": 31
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 45,
                                    "end": 47,
                                    "start_line": 1,
                                    "start_col": 45
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 50,
                                    "end": 52,
                                    "start_line": 1,
                                    "start_col": 50
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 45,
                              "end": 52,
                              "start_line": 1,
                              "start_col": 45
                            }
                          }
                        },
                        "span": {
                          "start": 38,
                          "end": 54,
                          "start_line": 1,
                          "start_col": 38
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 55,
                  "start_line": 1,
                  "start_col": 11
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
