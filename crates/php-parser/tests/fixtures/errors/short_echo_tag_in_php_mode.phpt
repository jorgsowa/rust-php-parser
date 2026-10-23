===source===
<?php
echo 1;
<?= 2;
===errors===
expected expression, found '<'
expected expression, found '?'
expected expression, found '='
expected ':', found ';'
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '<', expecting end of file in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "<", expecting end of file in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 11,
              "end": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 13
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": "Error",
                      "span": {
                        "start": 13,
                        "end": 13
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": "Error",
                      "span": {
                        "start": 15,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              },
              "then_expr": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": "Error",
                      "span": {
                        "start": 16,
                        "end": 16
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 19
                }
              },
              "else_expr": {
                "kind": "Error",
                "span": {
                  "start": 19,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 13,
            "end": 19
          }
        }
      },
      "span": {
        "start": 13,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
