===source===
<?php
function f(A&B|C $a) {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
expected '(' around an intersection type in a union, found '|'
===errors >=8.1===
expected '(' around an intersection type in a union, found '|'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'B' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "B", expecting variable in Standard input code on line 2
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "|", expecting variable in Standard input code on line 2
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
                "name": "a",
                "span": {
                  "start": 23,
                  "end": 25
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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 17,
                                  "end": 18
                                }
                              }
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 19,
                                  "end": 20
                                }
                              }
                            },
                            "span": {
                              "start": 19,
                              "end": 20
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 17,
                        "end": 20
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 22
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 22
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 25
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
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
