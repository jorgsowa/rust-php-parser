===source===
<?php
function foo(Foo|Foo $x) { }

===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type Foo is redundant
===errors >=8.0===
Duplicate type Foo is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Duplicate type Foo is redundant in Standard input code on line 2
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
                  "start": 27,
                  "end": 29
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Foo"
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
                            "Foo"
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
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 26
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
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
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
