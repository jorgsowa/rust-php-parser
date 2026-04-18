===config===
min_php=8.5
===source===
<?php $x |> ($x ? 'a' : 'b');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pipe",
              "right": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 18,
                            "end": 21
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "String": "b"
                          },
                          "span": {
                            "start": 24,
                            "end": 27
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
