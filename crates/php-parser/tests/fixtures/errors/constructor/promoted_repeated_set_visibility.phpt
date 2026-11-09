===source===
<?php
class A {
    public function __construct(public private(set) protected(set) int $p) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
Multiple access type modifiers are not allowed
===errors 8.0-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
Multiple access type modifiers are not allowed
===errors >=8.4===
Multiple access type modifiers are not allowed
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "private", expecting variable in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
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
                        "name": "p",
                        "span": {
                          "start": 87,
                          "end": 89
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
                              "start": 83,
                              "end": 86
                            }
                          }
                        },
                        "span": {
                          "start": 83,
                          "end": 86
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "set_visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 89
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
                "end": 93
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 95
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 95
  }
}
