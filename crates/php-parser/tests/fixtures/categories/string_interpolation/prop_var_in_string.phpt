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
                                "end": 21,
                                "start_line": 1,
                                "start_col": 17
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "name"
                              },
                              "span": {
                                "start": 23,
                                "end": 27,
                                "start_line": 1,
                                "start_col": 23
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 27,
                          "start_line": 1,
                          "start_col": 17
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
                  "end": 33,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 33,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
