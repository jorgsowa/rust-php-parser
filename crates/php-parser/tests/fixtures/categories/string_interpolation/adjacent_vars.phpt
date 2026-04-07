===source===
<?php $x = "$a$b$c"; 
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
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 12,
                          "end": 14
                        }
                      }
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 14,
                          "end": 16
                        }
                      }
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 16,
                          "end": 18
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
