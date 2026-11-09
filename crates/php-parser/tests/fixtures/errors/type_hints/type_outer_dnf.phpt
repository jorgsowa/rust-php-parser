===source===
<?php
function foo((Foo|Bar)&Baz $x) { }

===errors <=8.0===
expected '&', found '|'
'parenthesized union types' requires PHP 8.2 or higher
'intersection types' requires PHP 8.1 or higher
Type declarations cannot be union types, use DNF syntax (A&B)|C instead
===errors 8.1===
expected '&', found '|'
'parenthesized union types' requires PHP 8.2 or higher
Type declarations cannot be union types, use DNF syntax (A&B)|C instead
===errors >=8.2===
expected '&', found '|'
Type declarations cannot be union types, use DNF syntax (A&B)|C instead
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 2
===php_error 8.2-8.4===
PHP Parse error:  syntax error, unexpected token "|", expecting amp in Standard input code on line 2
===php_error >=8.5===
PHP Parse error:  syntax error, unexpected token "|", expecting token "&" in Standard input code on line 2
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
                  "start": 33,
                  "end": 35
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
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
                                  "Bar"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 24,
                                  "end": 27
                                }
                              }
                            },
                            "span": {
                              "start": 24,
                              "end": 27
                            }
                          }
                        ]
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
                            "Baz"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 29,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 32
                      }
                    }
                  ]
                },
                "span": {
                  "start": 19,
                  "end": 32
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 35
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
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
