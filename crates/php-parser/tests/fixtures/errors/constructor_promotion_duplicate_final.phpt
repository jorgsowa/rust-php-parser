===source===
<?php
class Foo {
    public function __construct(
        public final final string $x,
    ) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'final promoted properties' requires PHP 8.5 or higher
'final promoted properties' requires PHP 8.5 or higher
duplicate modifier 'final'
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors 8.0-8.4===
'final promoted properties' requires PHP 8.5 or higher
'final promoted properties' requires PHP 8.5 or higher
duplicate modifier 'final'
===errors >=8.5===
duplicate modifier 'final'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "final", expecting variable in Standard input code on line 4
===php_error 8.3-8.4===
PHP Fatal error:  Cannot use the final modifier on a parameter in Standard input code on line 4
===php_error >=8.5===
PHP Fatal error:  Multiple final modifiers are not allowed in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                      "start": 38,
                      "end": 49
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
                          "start": 85,
                          "end": 87
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
                              "start": 78,
                              "end": 84
                            }
                          }
                        },
                        "span": {
                          "start": 78,
                          "end": 84
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_final": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 59,
                        "end": 87
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 97
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 99
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99
  }
}
