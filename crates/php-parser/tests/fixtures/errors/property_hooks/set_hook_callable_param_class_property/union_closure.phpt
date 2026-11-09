===source===
<?php
class C {
    public Closure|int $c { set(callable|int $v) {} }
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'union types' requires PHP 8.0 or higher
Type of parameter $v of hook C::$c::set must be compatible with property type
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
Type of parameter $v of hook C::$c::set must be compatible with property type
===errors 8.4===
Type of parameter $v of hook C::$c::set must be compatible with property type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.4===
PHP Fatal error:  Type of parameter $v of hook C::$c::set must be compatible with property type in Standard input code on line 3
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
                    "name": "c",
                    "span": {
                      "start": 39,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Closure"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 27,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 27,
                            "end": 34
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
                                "start": 35,
                                "end": 38
                              }
                            }
                          },
                          "span": {
                            "start": 35,
                            "end": 38
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 27,
                      "end": 38
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
                              "start": 61,
                              "end": 63
                            }
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
                                        "start": 48,
                                        "end": 56
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 48,
                                    "end": 56
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
                                        "start": 57,
                                        "end": 60
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 57,
                                    "end": 60
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 48,
                              "end": 60
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 48,
                            "end": 63
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 44,
                        "end": 67
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
