===source===
<?php
function b(namespace\callable $z) {}
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
          "params": [
            {
              "name": {
                "name": "z",
                "span": {
                  "start": 36,
                  "end": 38
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "callable"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 17,
                      "end": 35
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 35
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 38
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
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
