===source===
<?php
class A {
    public function __construct(public void $g) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
void cannot be used as a parameter type
===errors >=8.0===
void cannot be used as a parameter type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  void cannot be used as a parameter type in Standard input code on line 3
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
                        "name": "g",
                        "span": {
                          "start": 60,
                          "end": 62
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "void"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 55,
                              "end": 59
                            }
                          }
                        },
                        "span": {
                          "start": 55,
                          "end": 59
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
                        "start": 48,
                        "end": 62
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
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
