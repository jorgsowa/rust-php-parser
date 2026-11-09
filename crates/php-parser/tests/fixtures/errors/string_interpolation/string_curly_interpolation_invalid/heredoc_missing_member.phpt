===source===
<?php
echo <<<EOT
  {$a->}
  EOT;
===errors===
expected member name, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting identifier (T_STRING) or variable (T_VARIABLE) or '{' or '$' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}", expecting identifier or variable or "{" or "$" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Heredoc": {
                "label": "EOT",
                "parts": [
                  {
                    "Expr": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 21,
                              "end": 23
                            }
                          },
                          "property": {
                            "kind": "Error",
                            "span": {
                              "start": 25,
                              "end": 25
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 25
                      }
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 11,
              "end": 32
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
