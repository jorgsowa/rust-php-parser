===source===
<?php
class A {
    public function __construct(private(set) int $f { set { } }) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
set-only virtual property A::$f must not specify asymmetric visibility
===errors 8.0-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
set-only virtual property A::$f must not specify asymmetric visibility
===errors >=8.4===
set-only virtual property A::$f must not specify asymmetric visibility
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'private' (T_PRIVATE), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 3
===php_error 8.2-8.3===
PHP Parse error:  syntax error, unexpected token ")", expecting amp in Standard input code on line 3
===php_error 8.4-8.5===
PHP Fatal error:  Write-only virtual property A::$f must not specify asymmetric visibility in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  set-only virtual property A::$f must not specify asymmetric visibility in Standard input code on line 3
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
                        "name": "f",
                        "span": {
                          "start": 65,
                          "end": 67
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
                              "start": 61,
                              "end": 64
                            }
                          }
                        },
                        "span": {
                          "start": 61,
                          "end": 64
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "set_visibility": "Private"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Set",
                          "body": {
                            "Block": []
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 70,
                            "end": 77
                          }
                        }
                      ],
                      "span": {
                        "start": 48,
                        "end": 79
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
                "end": 83
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 85
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 85
  }
}
