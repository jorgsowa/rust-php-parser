===source===
<?php
function foo(mixed&Foo $x) { }

===errors <=7.4===
'mixed type' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
Type mixed cannot be part of an intersection type
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
Type mixed cannot be part of an intersection type
===errors >=8.1===
Type mixed cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Foo' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Foo", expecting variable in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Type mixed cannot be part of an intersection type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 29,
                  "end": 31
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "mixed"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 24
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 24
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 25,
                            "end": 28
                          }
                        }
                      },
                      "span": {
                        "start": 25,
                        "end": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 28
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 31
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
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
