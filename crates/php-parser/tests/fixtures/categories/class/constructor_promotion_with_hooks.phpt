===source===
<?php
class Point {
    public function __construct(
        public readonly int $x,
        public private(set) int $y,
        protected int $z = 0,
    ) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
'asymmetric visibility' requires PHP 8.4 or higher
===errors 8.1-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 4
===php_error 8.1-8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Point",
            "span": {
              "start": 12,
              "end": 17
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 40,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 81,
                          "end": 83
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 77,
                              "end": 80
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 80
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 61,
                        "end": 83
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 117,
                          "end": 119
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 113,
                              "end": 116
                            }
                          }
                        },
                        "span": {
                          "start": 113,
                          "end": 116
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "set_visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 93,
                        "end": 119
                      }
                    },
                    {
                      "name": {
                        "name": "z",
                        "span": {
                          "start": 143,
                          "end": 145
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 139,
                              "end": 142
                            }
                          }
                        },
                        "span": {
                          "start": 139,
                          "end": 142
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 148,
                          "end": 149
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 129,
                        "end": 149
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 159
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 161
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 161
  }
}
