===source===
<?php
new $"A";
===errors===
expected variable, found string
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '"A"' (T_CONSTANT_ENCAPSED_STRING), expecting variable (T_VARIABLE) or '{' or '$' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected double-quoted string "A", expecting variable or "{" or "$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "A"
                    },
                    "span": {
                      "start": 11,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
