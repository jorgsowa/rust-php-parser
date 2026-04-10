===source===
<?php $x = "item $arr[-1] here"; 
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
                      "Literal": "item "
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
                                "start": 17,
                                "end": 21
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": -1
                              },
                              "span": {
                                "start": 22,
                                "end": 24
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 25
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
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
