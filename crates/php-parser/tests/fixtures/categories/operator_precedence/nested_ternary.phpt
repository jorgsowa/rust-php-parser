===source===
<?php $a ? $b : ($c ? $d : $e);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 11,
                  "end": 13
                }
              },
              "else_expr": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 17,
                            "end": 19
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Variable": "d"
                          },
                          "span": {
                            "start": 22,
                            "end": 24
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "e"
                          },
                          "span": {
                            "start": 27,
                            "end": 29
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 17,
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 16,
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
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
