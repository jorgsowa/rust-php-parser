===source===
<?php
function foo(int|string|int|string $x) { }

===errors <=7.4===
'union types' requires PHP 8.0 or higher
Duplicate type int is redundant
Duplicate type string is redundant
===errors >=8.0===
Duplicate type int is redundant
Duplicate type string is redundant
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Duplicate type int is redundant in Standard input code on line 2
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
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 23,
                            "end": 29
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 29
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
                            "start": 30,
                            "end": 33
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 33
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
                            "start": 34,
                            "end": 40
                          }
                        }
                      },
                      "span": {
                        "start": 34,
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
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
