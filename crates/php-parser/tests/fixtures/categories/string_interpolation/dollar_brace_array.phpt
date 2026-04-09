===source===
<?php $x = "${arr[0]}bar"; 
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
                                "start": 14,
                                "end": 17,
                                "start_line": 1,
                                "start_col": 14
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 18,
                                "end": 19,
                                "start_line": 1,
                                "start_col": 18
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 20,
                          "start_line": 1,
                          "start_col": 12
                        }
                      }
                    },
                    {
                      "Literal": "bar"
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
