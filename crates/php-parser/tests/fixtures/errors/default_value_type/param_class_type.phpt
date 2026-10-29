===source===
<?php
function f(Foo $x = 1) {}
===errors===
Cannot use int as default value for parameter $x of type Foo
===php_error <=7.4===
PHP Fatal error:  Default value for parameters with a class type can only be NULL in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Cannot use int as default value for parameter $x of type Foo in Standard input code on line 2
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
                  "start": 21,
                  "end": 23
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 20
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 20
                }
              },
              "default": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 26,
                  "end": 27
                }
              },
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
