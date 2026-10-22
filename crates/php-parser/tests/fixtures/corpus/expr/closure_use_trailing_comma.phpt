===source===
<?php
function() use($a,) {};
===errors <=7.4===
'trailing comma in closure use list' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting '&' or variable (T_VARIABLE) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [
                {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 21,
                      "end": 23
                    }
                  },
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 23
                  }
                }
              ],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
