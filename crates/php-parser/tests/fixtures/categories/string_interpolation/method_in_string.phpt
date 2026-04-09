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
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
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
                                "end": 23,
                                "start_line": 1,
                                "start_col": 19
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getName"
                              },
                              "span": {
                                "start": 25,
                                "end": 32,
                                "start_line": 1,
                                "start_col": 25
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 19,
                          "end": 34,
                          "start_line": 1,
                          "start_col": 19
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 36,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 36,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
