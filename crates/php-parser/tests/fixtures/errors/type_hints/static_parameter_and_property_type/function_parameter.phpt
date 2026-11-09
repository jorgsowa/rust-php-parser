===source===
<?php
function f(static $x) {}
===errors===
Cannot use the static modifier on a parameter
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "static", expecting variable in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use the static modifier on a parameter in Standard input code on line 2
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
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 24,
                  "end": 26
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 26
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
