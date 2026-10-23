===source===
<?php
$foo->
;
===errors===
expected member name, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting identifier (T_STRING) or variable (T_VARIABLE) or '{' or '$' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting identifier or variable or "{" or "$" in Standard input code on line 3
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
                  "Variable": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "property": {
                "kind": "Error",
                "span": {
                  "start": 12,
                  "end": 12
                }
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
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
