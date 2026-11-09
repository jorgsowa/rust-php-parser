===source===
<?php
function f() { static $b,; }
===errors===
expected variable, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting variable in Standard input code on line 2
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
                "StaticVar": [
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 28,
                        "end": 30
                      }
                    },
                    "default": null,
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
