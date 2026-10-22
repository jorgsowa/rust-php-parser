===source===
<?php
function foo((Foo&mixed)|Bar $x) { }

===errors <=7.4===
'mixed type' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
'union types' requires PHP 8.0 or higher
'DNF types' requires PHP 8.2 or higher
Type mixed cannot be part of an intersection type
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
'DNF types' requires PHP 8.2 or higher
Type mixed cannot be part of an intersection type
===errors 8.1===
'DNF types' requires PHP 8.2 or higher
Type mixed cannot be part of an intersection type
===errors >=8.2===
Type mixed cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 2
===php_error >=8.2===
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
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 20,
                                  "end": 23
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 23
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "mixed"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 24,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 29
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 19,
                        "end": 30
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Bar"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 31,
                            "end": 34
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 34
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 34
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 37
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
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
