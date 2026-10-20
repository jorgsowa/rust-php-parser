===source===
<?php
$a = function() use () {};
===errors >=8.5===
expected variable, found ')'
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected token ")", expecting "&" or variable in Standard input code on line 2
===php_error 8.1-8.4===
PHP Parse error:  syntax error, unexpected token ")", expecting variable or "&" or amp in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token ")", expecting variable or "&" or token "&" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
