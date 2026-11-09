===source===
<?php
function b($a = new $x) {}
===errors <=8.0===
'new in initializers' requires PHP 8.1 or higher
===errors >=8.1===
Cannot use dynamic class name in constant expression
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot use dynamic class name in constant expression in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 26,
                        "end": 28
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 28
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 28
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
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
