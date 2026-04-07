===source===
<?php $x = "{$obj->$prop}"; 
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
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 13,
                                "end": 17
                              }
                            },
                            "property": {
                              "kind": {
                                "Variable": "prop"
                              },
                              "span": {
                                "start": 19,
                                "end": 24
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 24
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
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
