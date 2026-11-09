===source===
<?php
$"abc";
===errors===
expected variable, found string
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '"abc"' (T_CONSTANT_ENCAPSED_STRING), expecting variable (T_VARIABLE) or '{' or '$' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected double-quoted string "abc", expecting variable or "{" or "$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "VariableVariable": {
              "kind": {
                "String": "abc"
              },
              "span": {
                "start": 7,
                "end": 12
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
