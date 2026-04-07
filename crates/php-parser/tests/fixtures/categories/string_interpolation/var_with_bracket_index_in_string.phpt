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
                  "end": 8
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
                                "end": 16
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 17,
                                "end": 18
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 19
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
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
