===source===
<?php
class C {
    public function __construct(private protected(set) string $a, protected(set) string $b) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
Visibility of property C::$a must not be weaker than set visibility
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
===errors 8.0-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
Visibility of property C::$a must not be weaker than set visibility
'asymmetric visibility' requires PHP 8.4 or higher
===errors >=8.4===
Visibility of property C::$a must not be weaker than set visibility
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'private' (T_PRIVATE), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "protected", expecting variable in Standard input code on line 3
===php_error 8.1-8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Visibility of property C::$a must not be weaker than set visibility in Standard input code on line 3
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 78,
                          "end": 80
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 71,
                              "end": 77
                            }
                          }
                        },
                        "span": {
                          "start": 71,
                          "end": 77
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private",
                        "set_visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 80
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 104,
                          "end": 106
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 97,
                              "end": 103
                            }
                          }
                        },
                        "span": {
                          "start": 97,
                          "end": 103
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "set_visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 82,
                        "end": 106
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 110
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 112
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 112
  }
}
