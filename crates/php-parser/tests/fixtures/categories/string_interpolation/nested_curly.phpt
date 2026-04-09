===source===
<?php $x = "Value: {$arr['key']}"; 
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
                      "Literal": "Value: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 20,
                                "end": 24,
                                "start_line": 1,
                                "start_col": 20
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "key"
                              },
                              "span": {
                                "start": 25,
                                "end": 30,
                                "start_line": 1,
                                "start_col": 25
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 20,
                          "end": 31,
                          "start_line": 1,
                          "start_col": 20
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
