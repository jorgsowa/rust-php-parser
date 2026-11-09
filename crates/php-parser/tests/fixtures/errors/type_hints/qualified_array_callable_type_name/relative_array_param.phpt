===source===
<?php
function a(Foo\array $x) {}
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Cannot use "Foo\array" as a type name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use "Foo\array" as a type name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
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
                  "start": 27,
                  "end": 29
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "array"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 17,
                      "end": 26
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 26
                }
              },
              "default": null,
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
