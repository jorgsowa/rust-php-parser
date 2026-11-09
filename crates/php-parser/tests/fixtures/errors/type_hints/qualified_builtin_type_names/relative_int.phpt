===source===
<?php
function b(Foo\int $a) {}
===errors===
Cannot use "Foo\int" as a type name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'Foo\int' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "Foo\int" as a type name as it is reserved in Standard input code on line 2
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
                  "start": 25,
                  "end": 27
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
                      "start": 17,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 24
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 27
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
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
