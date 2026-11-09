===source===
<?php
$a->$"b";
===errors===
expected variable, found string
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '"b"' (T_CONSTANT_ENCAPSED_STRING), expecting variable (T_VARIABLE) or '{' or '$' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected double-quoted string "b", expecting variable or "{" or "$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "property": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "b"
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
              }
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
