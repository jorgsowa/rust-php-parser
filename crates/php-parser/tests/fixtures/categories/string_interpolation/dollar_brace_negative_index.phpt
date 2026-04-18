===source===
<?php $x = "${var[-1]}";
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
                                "Variable": "var"
                              },
                              "span": {
                                "start": 14,
                                "end": 17
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": -1
                              },
                              "span": {
                                "start": 18,
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
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
