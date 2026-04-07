===source===
<?php $x = "Name: {$obj->getName()}"; 
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
                      "Literal": "Name: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 19,
                                "end": 23
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getName"
                              },
                              "span": {
                                "start": 25,
                                "end": 32
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 19,
                          "end": 34
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
