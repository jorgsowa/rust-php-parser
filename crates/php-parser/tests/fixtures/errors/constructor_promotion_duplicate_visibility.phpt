===source===
<?php
class Foo {
    public function __construct(
        public public string $x,
    ) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
cannot use multiple visibility modifiers
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors >=8.0===
cannot use multiple visibility modifiers
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "public", expecting variable in Standard input code on line 4
===php_error >=8.1===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 4
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
                          "start": 80,
                          "end": 82
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
                              "start": 73,
                              "end": 79
                            }
                          }
                        },
                        "span": {
                          "start": 73,
                          "end": 79
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 59,
                        "end": 82
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
