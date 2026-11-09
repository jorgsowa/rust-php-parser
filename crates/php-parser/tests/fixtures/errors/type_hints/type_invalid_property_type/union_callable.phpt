===source===
<?php
class A {
    private callable|int|null $e;
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
Property A::$e cannot have type callable|int|null
===errors >=8.0===
Property A::$e cannot have type callable|int|null
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Property A::$e cannot have type callable|int|null in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 46,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "callable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 28,
                                "end": 36
                              }
                            }
                          },
                          "span": {
                            "start": 28,
                            "end": 36
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
                                "start": 37,
                                "end": 40
                              }
                            }
                          },
                          "span": {
                            "start": 37,
                            "end": 40
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "null"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 41,
                                "end": 45
                              }
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 45
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 28,
                      "end": 45
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
