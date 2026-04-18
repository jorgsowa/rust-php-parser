===source===
<?php $x = <<<EOT
$arr[]
EOT;
===errors===
empty index in string interpolation
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
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "arr"
                          },
                          "span": {
                            "start": 18,
                            "end": 22
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "]", expecting "-" or identifier or variable or number in Standard input code on line 2
