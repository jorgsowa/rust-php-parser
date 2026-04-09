===source===
<?php $x = "$arr[foo] here";
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
                                "String": "foo"
                              },
                              "span": {
                                "start": 17,
                                "end": 20,
                                "start_line": 1,
                                "start_col": 17
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 21,
                          "start_line": 1,
                          "start_col": 12
                        }
                      }
                    },
                    {
                      "Literal": " here"
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 27,
                  "start_line": 1,
                  "start_col": 11
                }
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
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}
