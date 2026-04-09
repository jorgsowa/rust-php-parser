===source===
<?php $x = "{$a[$b][$c]}"; 
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
                  "Variable": "x"
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
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 13,
                                      "end": 15,
                                      "start_line": 1,
                                      "start_col": 13
                                    }
                                  },
                                  "index": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 18,
                                      "start_line": 1,
                                      "start_col": 16
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 13,
                                "end": 19,
                                "start_line": 1,
                                "start_col": 13
                              }
                            },
                            "index": {
                              "kind": {
                                "Variable": "c"
                              },
                              "span": {
                                "start": 20,
                                "end": 22,
                                "start_line": 1,
                                "start_col": 20
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 23,
                          "start_line": 1,
                          "start_col": 13
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27,
    "start_line": 1,
    "start_col": 0
  }
}
