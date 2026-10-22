===source===
<?php
switch ($a) {
    case 1:
    endfor
}
===errors===
expected expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'endfor' (T_ENDFOR), expecting case (T_CASE) or default (T_DEFAULT) or '}' in Standard input code on line 4
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "endfor", expecting "case" or "default" or "}" in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Switch": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 14,
              "end": 16
            }
          },
          "cases": [
            {
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 29,
                  "end": 30
                }
              },
              "body": [
                {
                  "kind": "Error",
                  "span": {
                    "start": 36,
                    "end": 31
                  }
                }
              ],
              "span": {
                "start": 24,
                "end": 42
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
