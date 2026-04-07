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
                                "start": 14,
                                "end": 17
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 18,
                                "end": 19
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 20
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
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
