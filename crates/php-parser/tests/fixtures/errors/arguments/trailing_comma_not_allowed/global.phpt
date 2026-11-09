===source===
<?php
function f() { global $a,; }
===errors===
expected variable, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting variable (T_VARIABLE) or '$' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting variable or "$" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 28,
                      "end": 30
                    }
                  }
                ]
              },
              "span": {
                "start": 21,
                "end": 32
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
