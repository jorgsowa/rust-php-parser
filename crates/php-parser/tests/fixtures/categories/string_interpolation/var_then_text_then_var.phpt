===source===
<?php $x = "$a-$b";
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
                      "Literal": "-"
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 15,
                          "end": 17
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
