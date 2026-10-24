===source===
<?php
function f(string $x = 1) {}
===errors <=7.4===
Default value for parameters with a string type can only be string or NULL
===errors >=8.0===
Cannot use int as default value for parameter $x of type string
===php_error <=7.4===
PHP Fatal error:  Default value for parameters with a string type can only be string or NULL in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Cannot use int as default value for parameter $x of type string in Standard input code on line 2
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
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 23
                }
              },
              "default": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 29,
                  "end": 30
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 30
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
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
