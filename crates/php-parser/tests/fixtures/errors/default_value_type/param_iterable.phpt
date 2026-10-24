===source===
<?php
function f(iterable $x = 1) {}
===errors <=7.4===
Default value for parameters with iterable type can only be an array or NULL
===errors 8.0-8.1===
Cannot use int as default value for parameter $x of type iterable
===errors >=8.2===
Cannot use int as default value for parameter $x of type Traversable|array
===php_error <=7.4===
PHP Fatal error:  Default value for parameters with iterable type can only be an array or NULL in Standard input code on line 2
===php_error 8.0-8.1===
PHP Fatal error:  Cannot use int as default value for parameter $x of type iterable in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Cannot use int as default value for parameter $x of type Traversable|array in Standard input code on line 2
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
                      "iterable"
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
                  "Int": 1
                },
                "span": {
                  "start": 31,
                  "end": 32
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 32
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
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
