===source===
<?php $x = match ($y) { 1 => }; $z = 42;
===errors===
expected expression
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
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 18,
                        "end": 20
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 24,
                              "end": 25
                            }
                          }
                        ],
                        "body": {
                          "kind": "Error",
                          "span": {
                            "start": 29,
                            "end": 30
                          }
                        },
                        "span": {
                          "start": 24,
                          "end": 30
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 32,
                  "end": 34
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 42
                },
                "span": {
                  "start": 37,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 39
          }
        }
      },
      "span": {
        "start": 32,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "}" in Standard input code on line 1
