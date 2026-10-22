===source===
<?php function f() { static $a, }
===errors===
expected variable, found '}'
expected ';', found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}', expecting variable (T_VARIABLE) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}", expecting variable in Standard input code on line 1
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
                      "name": "a",
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
                  },
                  {
                    "name": null,
                    "default": null,
                    "span": {
                      "start": 32,
                      "end": 32
                    }
                  }
                ]
              },
              "span": {
                "start": 21,
                "end": 31
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
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
