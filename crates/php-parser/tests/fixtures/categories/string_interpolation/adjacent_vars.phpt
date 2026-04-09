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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 12,
                          "end": 14,
                          "start_line": 1,
                          "start_col": 12
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
                          "end": 16,
                          "start_line": 1,
                          "start_col": 14
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
                          "end": 18,
                          "start_line": 1,
                          "start_col": 16
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21,
    "start_line": 1,
    "start_col": 0
  }
}
