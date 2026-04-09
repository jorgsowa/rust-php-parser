===source===
<?php $x = "$arr[0] end";
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
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 12,
                                "end": 16,
                                "start_line": 1,
                                "start_col": 12
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 17,
                                "end": 18,
                                "start_line": 1,
                                "start_col": 17
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 19,
                          "start_line": 1,
                          "start_col": 12
                        }
                      }
                    },
                    {
                      "Literal": " end"
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 1,
            "start_col": 6
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
  ],
  "span": {
    "start": 0,
    "end": 25,
    "start_line": 1,
    "start_col": 0
  }
}
