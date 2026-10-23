===source===
<?php
$
===errors===
expected variable, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting variable (T_VARIABLE) or '{' or '$' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting variable or "{" or "$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": "Error",
              "span": {
                "start": 7,
                "end": 7
              }
            }
          },
          "span": {
            "start": 6,
            "end": 7
          }
        }
      },
      "span": {
        "start": 6,
        "end": 7
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 7
  }
}
