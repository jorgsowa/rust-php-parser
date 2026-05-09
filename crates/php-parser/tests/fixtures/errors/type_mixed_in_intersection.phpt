===config===
min_php=8.1

===source===
<?php
function foo(mixed&Foo $x) { }

===errors===
mixed cannot be used in intersection types
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
===php_error===
PHP Fatal error:  Type mixed cannot be part of an intersection type in Standard input code on line 2
