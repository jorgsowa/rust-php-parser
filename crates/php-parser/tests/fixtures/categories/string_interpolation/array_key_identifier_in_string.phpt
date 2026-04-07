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
                                "String": "foo"
                              },
                              "span": {
                                "start": 17,
                                "end": 20
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 21
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
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
