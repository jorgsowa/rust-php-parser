===source===
<?php
$1;
===errors===
expected variable, found integer
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '1' (T_LNUMBER), expecting variable (T_VARIABLE) or '{' or '$' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected integer "1", expecting variable or "{" or "$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 7,
                "end": 8
              }
            }
          },
          "span": {
            "start": 6,
            "end": 8
          }
        }
      },
      "span": {
        "start": 6,
        "end": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 9
  }
}
