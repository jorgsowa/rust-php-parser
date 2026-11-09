===source===
<?php
class A {
    public function __construct(public readonly int $c) {}
    public $c;
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
Cannot redeclare A::$c
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
Cannot redeclare A::$c
===errors >=8.1===
Cannot redeclare A::$c
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Cannot redeclare A::$c in Standard input code on line 4
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
                        "name": "c",
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
                      "span": {
                        "start": 48,
                        "end": 70
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
                "end": 74
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 86,
                      "end": 88
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 79,
                "end": 88
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
