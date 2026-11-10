===source===
<?php
function f((A&B)&C &$x) {}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
'intersection types' requires PHP 8.1 or higher
expected '|', found '&'
===errors >=8.1===
expected '|', found '&'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 2
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 2
===php_error >=8.2===
PHP Parse error:  syntax error, unexpected token "&", expecting "|" in Standard input code on line 2
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
                  "start": 26,
                  "end": 28
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
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
                                  "start": 18,
                                  "end": 19
                                }
                              }
                            },
                            "span": {
                              "start": 18,
                              "end": 19
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
                                  "start": 20,
                                  "end": 21
                                }
                              }
                            },
                            "span": {
                              "start": 20,
                              "end": 21
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 17,
                        "end": 22
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
                            "start": 23,
                            "end": 24
                          }
                        }
                      },
                      "span": {
                        "start": 23,
                        "end": 24
                      }
                    }
                  ]
                },
                "span": {
                  "start": 17,
                  "end": 24
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 28
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
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
