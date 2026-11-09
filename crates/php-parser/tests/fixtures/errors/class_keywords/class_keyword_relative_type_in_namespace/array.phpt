===source===
<?php
namespace N;
function g(namespace\array $a) {}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Cannot use "N\array" as a type name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY), expecting identifier (T_STRING) in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Cannot use "N\array" as a type name as it is reserved in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 28,
              "end": 29
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 46,
                  "end": 48
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
                      "start": 30,
                      "end": 45
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 45
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 30,
                "end": 48
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
        "start": 19,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
