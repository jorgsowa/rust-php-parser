===source===
<?php $cond ?: $c = $d;
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
              "then_expr": null,
              "else_expr": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 15,
                        "end": 17
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 20,
                        "end": 22
                      }
                    }
                  }
                },
                "span": {
                  "start": 15,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
