===source===
<?php $cond ? $b : $c = $d;
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
                  "Variable": "cond"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 14,
                  "end": 16
                }
              },
              "else_expr": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 19,
                        "end": 21
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 24,
                        "end": 26
                      }
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
