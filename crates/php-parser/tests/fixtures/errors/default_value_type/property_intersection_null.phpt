===source===
<?php
class A {
    public A&B $x = null;
}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
Cannot use null as default value for property A::$x of type A&B
===errors >=8.1===
Cannot use null as default value for property A::$x of type A&B
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting variable in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Cannot use null as default value for property A::$x of type A&B in Standard input code on line 3
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
                    "name": "x",
                    "span": {
                      "start": 31,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
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
                                "start": 27,
                                "end": 28
                              }
                            }
                          },
                          "span": {
                            "start": 27,
                            "end": 28
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
                                "start": 29,
                                "end": 30
                              }
                            }
                          },
                          "span": {
                            "start": 29,
                            "end": 30
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 27,
                      "end": 30
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 36,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
