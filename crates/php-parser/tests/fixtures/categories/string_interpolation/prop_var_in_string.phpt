===source===
<?php $x = "name $obj->name here"; 
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
                      "Literal": "name "
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
                                "start": 17,
                                "end": 21
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "name"
                              },
                              "span": {
                                "start": 23,
                                "end": 27
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 27
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
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
