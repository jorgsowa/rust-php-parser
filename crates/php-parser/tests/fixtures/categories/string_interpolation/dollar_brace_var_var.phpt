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
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 14,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
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
                  "end": 21
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
                              "end": 32
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 33
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 19,
            "end": 34
          }
        }
      },
      "span": {
        "start": 19,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
