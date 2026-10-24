===source===
<?php
<<<EOT
$a[1_]
EOT;
===errors===
invalid offset in simple string interpolation
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '_' (T_STRING), expecting ']' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected identifier "_", expecting "]" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "EOT",
              "parts": [
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "1_"
                          },
                          "span": {
                            "start": 16,
                            "end": 18
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 19
                    }
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
