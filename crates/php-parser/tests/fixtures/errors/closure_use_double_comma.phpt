===source===
<?php
$a = function() use ($a,,) {};
===errors <=7.4===
expected variable, found ','
'trailing comma in closure use list' requires PHP 8.0 or higher
===errors >=8.0===
expected variable, found ','
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',', expecting '&' or variable (T_VARIABLE) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ",", expecting ")" in Standard input code on line 2
===ast===
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
                    "use_vars": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 27,
                            "end": 29
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 27,
                          "end": 29
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
