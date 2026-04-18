===source===
<?php $x = "${var[PHP_INT_MAX]}";
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
                                "String": "PHP_INT_MAX"
                              },
                              "span": {
                                "start": 18,
                                "end": 29
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 30
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
