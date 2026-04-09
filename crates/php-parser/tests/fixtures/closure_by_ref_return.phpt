===source===
<?php $f = function &() { static $x = 0; return $x; };
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
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "StaticVar": [
                            {
                              "name": "x",
                              "default": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 38,
                                  "end": 39,
                                  "start_line": 1,
                                  "start_col": 38
                                }
                              },
                              "span": {
                                "start": 33,
                                "end": 39,
                                "start_line": 1,
                                "start_col": 33
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 26,
                          "end": 41,
                          "start_line": 1,
                          "start_col": 26
                        }
                      },
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 48,
                              "end": 50,
                              "start_line": 1,
                              "start_col": 48
                            }
                          }
                        },
                        "span": {
                          "start": 41,
                          "end": 52,
                          "start_line": 1,
                          "start_col": 41
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 53,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 53,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54,
    "start_line": 1,
    "start_col": 0
  }
}
