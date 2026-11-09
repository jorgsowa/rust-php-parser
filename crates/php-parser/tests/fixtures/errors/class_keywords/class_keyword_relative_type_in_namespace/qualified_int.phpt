===source===
<?php
namespace N;
function g(Foo\int $b) {}
===errors===
Cannot use "N\Foo\int" as a type name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'N\Foo\int' as class name as it is reserved in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use "N\Foo\int" as a type name as it is reserved in Standard input code on line 3
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
                "name": "b",
                "span": {
                  "start": 38,
                  "end": 40
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo",
                      "int"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 30,
                      "end": 37
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 37
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 30,
                "end": 40
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
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
