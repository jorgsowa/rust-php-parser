===source===
<?php
function f(int $x = "a") {}
===errors===
Cannot use string as default value for parameter $x of type int
===php_error <=7.4===
PHP Fatal error:  Default value for parameters with a int type can only be int or NULL in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Cannot use string as default value for parameter $x of type int in Standard input code on line 2
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
                  "start": 21,
                  "end": 23
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 20
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 20
                }
              },
              "default": {
                "kind": {
                  "String": "a"
                },
                "span": {
                  "start": 26,
                  "end": 29
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 29
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
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
