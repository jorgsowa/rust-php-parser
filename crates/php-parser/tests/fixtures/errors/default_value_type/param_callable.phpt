===source===
<?php
function f(callable $x = "strlen") {}
===errors <=7.4===
Default value for parameters with callable type can only be NULL
===errors >=8.0===
Cannot use string as default value for parameter $x of type callable
===php_error <=7.4===
PHP Fatal error:  Default value for parameters with callable type can only be NULL in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Cannot use string as default value for parameter $x of type callable in Standard input code on line 2
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
                  "start": 26,
                  "end": 28
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "callable"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 25
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 25
                }
              },
              "default": {
                "kind": {
                  "String": "strlen"
                },
                "span": {
                  "start": 31,
                  "end": 39
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 39
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
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
