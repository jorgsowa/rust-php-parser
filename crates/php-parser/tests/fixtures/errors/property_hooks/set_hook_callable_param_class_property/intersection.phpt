===source===
<?php
class C {
    public A&B $d { set(callable $v) {} }
}
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
'property hooks' requires PHP 8.4 or higher
Type of parameter $v of hook C::$d::set must be compatible with property type
===errors 8.1-8.3===
'property hooks' requires PHP 8.4 or higher
Type of parameter $v of hook C::$d::set must be compatible with property type
===errors >=8.4===
Type of parameter $v of hook C::$d::set must be compatible with property type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '&', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting variable in Standard input code on line 3
===php_error 8.1-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Type of parameter $v of hook C::$d::set must be compatible with property type in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "d",
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
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 49,
                              "end": 51
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "callable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 40,
                                  "end": 48
                                }
                              }
                            },
                            "span": {
                              "start": 40,
                              "end": 48
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 40,
                            "end": 51
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 55
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
