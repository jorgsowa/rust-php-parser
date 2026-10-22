===source===
<?php $s = "text ${$var";
===errors===
unterminated string literal
unclosed '${' in string interpolation
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '"' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected double-quote mark in Standard input code on line 1
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
                  "Variable": "s"
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
                      "Literal": "text "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "VariableVariable": {
                            "kind": {
                              "Variable": "var"
                            },
                            "span": {
                              "start": 19,
                              "end": 23
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 25
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
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
