===source===
<?php $name = 'x'; $x = "${$name}"; 
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
                  "Variable": "name"
                },
                "span": {
                  "start": 6,
                  "end": 11,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 14,
                  "end": 17,
                  "start_line": 1,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 1,
        "start_col": 6
      }
    },
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
                  "start": 19,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 19
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "VariableVariable": {
                            "kind": {
                              "Variable": "name"
                            },
                            "span": {
                              "start": 27,
                              "end": 32,
                              "start_line": 1,
                              "start_col": 27
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 33,
                          "start_line": 1,
                          "start_col": 25
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 24
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 34,
            "start_line": 1,
            "start_col": 19
          }
        }
      },
      "span": {
        "start": 19,
        "end": 36,
        "start_line": 1,
        "start_col": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
