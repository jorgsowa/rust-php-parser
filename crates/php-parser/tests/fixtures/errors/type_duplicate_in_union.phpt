===config===
min_php=8.0

===source===
<?php
function foo(int|int|string $x) { }

===errors===
Duplicate type 'int' in union type
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
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 22
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 26
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 26
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 27,
                            "end": 33
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 33
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 33
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
                "end": 36
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
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
===php_error===
PHP Fatal error:  Duplicate type int is redundant in Standard input code on line 2
