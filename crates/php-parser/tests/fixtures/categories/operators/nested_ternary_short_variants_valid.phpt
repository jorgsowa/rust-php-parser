===source===
<?php
$a ?: $b ?: $c;
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
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "then_expr": null,
              "else_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 18,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
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
