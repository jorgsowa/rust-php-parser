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
                  "end": 8
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
                                "end": 24
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "key"
                              },
                              "span": {
                                "start": 25,
                                "end": 30
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 20,
                          "end": 31
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
