===source===
<?php function foo(Countable&Traversable $x) {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Traversable' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Traversable", expecting variable in Standard input code on line 1
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
                  "start": 41,
                  "end": 43
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Countable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 19,
                            "end": 28
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 28
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Traversable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 29,
                            "end": 40
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 40
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 40
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
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
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
