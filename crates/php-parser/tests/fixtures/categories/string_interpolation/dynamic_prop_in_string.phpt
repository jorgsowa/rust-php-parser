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
                      "Expr": {
                        "kind": {
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 13,
                                "end": 17,
                                "start_line": 1,
                                "start_col": 13
                              }
                            },
                            "property": {
                              "kind": {
                                "Variable": "prop"
                              },
                              "span": {
                                "start": 19,
                                "end": 24,
                                "start_line": 1,
                                "start_col": 19
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 24,
                          "start_line": 1,
                          "start_col": 13
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}
