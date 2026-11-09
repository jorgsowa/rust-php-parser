===source===
<?php
readonly class B {
    public function __construct(public int $k { get => 1; }) {}
}
===errors <=7.4===
'readonly class' requires PHP 8.2 or higher
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors 8.0-8.1===
'readonly class' requires PHP 8.2 or higher
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors 8.2-8.3===
'property hooks' requires PHP 8.4 or higher
Hooked properties cannot be readonly
===errors >=8.4===
Hooked properties cannot be readonly
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error 8.2-8.3===
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
            "name": "B",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
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
                      "start": 45,
                      "end": 56
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "k",
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
                        "visibility": "Public"
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
                        "start": 57,
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
                "start": 29,
                "end": 88
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}
