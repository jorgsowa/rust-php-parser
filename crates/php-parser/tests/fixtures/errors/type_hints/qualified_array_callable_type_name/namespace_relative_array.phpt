===source===
<?php
function b(namespace\array $y) {}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Cannot use "array" as a type name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use "array" as a type name as it is reserved in Standard input code on line 2
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
                "name": "y",
                "span": {
                  "start": 33,
                  "end": 35
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Relative",
                    "span": {
                      "start": 17,
                      "end": 32
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 32
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 35
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
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
