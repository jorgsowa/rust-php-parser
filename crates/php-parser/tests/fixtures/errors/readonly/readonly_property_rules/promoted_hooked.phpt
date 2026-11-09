===source===
<?php
class A {
    public function __construct(public readonly int $f { get => 1; }) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors 8.1-8.3===
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors >=8.4===
Hooked properties cannot be readonly
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 3
===php_error 8.1-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Hooked properties cannot be readonly in Standard input code on line 3
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
                          "start": 68,
                          "end": 70
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
                              "start": 64,
                              "end": 67
                            }
                          }
                        },
                        "span": {
                          "start": 64,
                          "end": 67
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
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 80,
                                "end": 81
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 73,
                            "end": 82
                          }
                        }
                      ],
                      "span": {
                        "start": 48,
                        "end": 84
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
                "end": 88
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}
