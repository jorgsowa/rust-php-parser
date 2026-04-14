===source===
<?php $a ? $b ?? $c : $d;
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
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 17,
                        "end": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 19
                }
              },
              "else_expr": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 22,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
