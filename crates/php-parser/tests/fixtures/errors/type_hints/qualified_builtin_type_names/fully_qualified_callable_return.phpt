===source===
<?php
function b(): \callable {}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Cannot use "callable" as a type name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'callable' (T_CALLABLE), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use "callable" as a type name as it is reserved in Standard input code on line 2
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
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "callable"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 20,
                  "end": 29
                }
              }
            },
            "span": {
              "start": 20,
              "end": 29
            }
          },
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
