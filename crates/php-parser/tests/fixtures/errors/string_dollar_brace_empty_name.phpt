===source===
<?php $x = "${}";
===errors===
empty variable name in '${...}' string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}" in Standard input code on line 1
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
                          "VariableVariable": {
                            "kind": "Error",
                            "span": {
                              "start": 14,
                              "end": 14
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 15
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
