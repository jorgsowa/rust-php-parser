===source===
<?php match($x) { 1 => }
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
expected expression, found '}'
expected ';' after expression
===errors >=8.0===
expected expression, found '}'
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=>' (T_DOUBLE_ARROW) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              },
              "arms": [
                {
                  "conditions": [
                    {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ],
                  "body": {
                    "kind": "Error",
                    "span": {
                      "start": 22,
                      "end": 22
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 22
                  }
                }
              ]
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
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
