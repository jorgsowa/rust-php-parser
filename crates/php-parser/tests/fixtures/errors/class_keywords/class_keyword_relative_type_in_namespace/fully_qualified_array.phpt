===source===
<?php
namespace N;
function g(\Foo\Array $c) {}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Cannot use "Foo\Array" as a type name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Array' (T_ARRAY), expecting identifier (T_STRING) in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Cannot use "Foo\Array" as a type name as it is reserved in Standard input code on line 3
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
                "name": "c",
                "span": {
                  "start": 41,
                  "end": 43
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "Array"
                    ],
                    "kind": "FullyQualified",
                    "span": {
                      "start": 30,
                      "end": 40
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 40
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 30,
                "end": 43
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
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
