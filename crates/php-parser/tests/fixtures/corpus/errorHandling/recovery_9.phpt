===source===
<?php
$foo->
;
===errors===
expected member name, found ';'
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
                  "start": 13,
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
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting identifier or variable or "{" or "$" in Standard input code on line 3
