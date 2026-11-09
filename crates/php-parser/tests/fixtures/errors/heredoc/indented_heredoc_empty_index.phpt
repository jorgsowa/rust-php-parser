===source===
<?php
$x = <<<EOT
    $a[]
    EOT;
===errors===
empty index in string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ']', expecting '-' or identifier (T_STRING) or variable (T_VARIABLE) or number (T_NUM_STRING) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "]", expecting "-" or identifier or variable or number in Standard input code on line 3
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
                            "Variable": "a"
                          },
                          "span": {
                            "start": 22,
                            "end": 24
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
