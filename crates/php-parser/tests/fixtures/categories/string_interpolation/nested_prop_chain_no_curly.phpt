===source===
<?php $x = "val $obj->a->b end";
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
                      "Literal": "val "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 16,
                                "end": 20
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "a"
                              },
                              "span": {
                                "start": 22,
                                "end": 23
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 16,
                          "end": 23
                        }
                      }
                    },
                    {
                      "Literal": "->b end"
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
