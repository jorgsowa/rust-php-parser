===source===
<?php
class A {
    const int|callable D = 1;
}
===errors <=7.4===
'typed class constants' requires PHP 8.3 or higher
'union types' requires PHP 8.0 or higher
Class constant A::D cannot have type callable|int
===errors 8.0-8.2===
'typed class constants' requires PHP 8.3 or higher
Class constant A::D cannot have type callable|int
===errors >=8.3===
Class constant A::D cannot have type callable|int
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting '=' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "|", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Class constant A::D cannot have type callable|int in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "D",
                    "span": {
                      "start": 39,
                      "end": 40
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
                                "start": 26,
                                "end": 29
                              }
                            }
                          },
                          "span": {
                            "start": 26,
                            "end": 29
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "callable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 30,
                                "end": 38
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 38
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 26,
                      "end": 38
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 45
              }
            }
          ],
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
