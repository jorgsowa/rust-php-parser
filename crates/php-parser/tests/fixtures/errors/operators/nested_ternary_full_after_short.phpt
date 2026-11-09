===source===
<?php
$a ?: $b ? $c : $d;
===errors >=8.0===
Unparenthesized `a ?: b ? c : d` is not supported. Use either `(a ?: b) ? c : d` or `a ?: (b ? c : d)`
===php_error >=8.0===
PHP Fatal error:  Unparenthesized `a ?: b ? c : d` is not supported. Use either `(a ?: b) ? c : d` or `a ?: (b ? c : d)` in Standard input code on line 2
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
              "then_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 17,
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
