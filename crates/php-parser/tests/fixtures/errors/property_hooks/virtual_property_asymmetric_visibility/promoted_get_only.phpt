===source===
<?php
class A {
    public function __construct(public private(set) int $e { get => 1; }) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property A::$e must not specify asymmetric visibility
===errors 8.0-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property A::$e must not specify asymmetric visibility
===errors >=8.4===
get-only virtual property A::$e must not specify asymmetric visibility
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "private", expecting variable in Standard input code on line 3
===php_error 8.1-8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===php_error 8.4-8.5===
PHP Fatal error:  Read-only virtual property A::$e must not specify asymmetric visibility in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  get-only virtual property A::$e must not specify asymmetric visibility in Standard input code on line 3
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
                        "name": "e",
                        "span": {
                          "start": 72,
                          "end": 74
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
                              "start": 68,
                              "end": 71
                            }
                          }
                        },
                        "span": {
                          "start": 68,
                          "end": 71
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
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 84,
                                "end": 85
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 77,
                            "end": 86
                          }
                        }
                      ],
                      "span": {
                        "start": 48,
                        "end": 88
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
                "end": 92
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
