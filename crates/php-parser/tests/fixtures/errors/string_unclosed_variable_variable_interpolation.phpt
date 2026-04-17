===source===
<?php $s = "text ${$var";
===errors===
unclosed '${' in string interpolation
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
                          "end": 23
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
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
===php_error===
PHP Parse error:  syntax error, unexpected double-quote mark in Standard input code on line 1
