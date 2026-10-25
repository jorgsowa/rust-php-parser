===source===
<?php
class A {
    public function __construct(private int $a = null) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
===errors >=8.0===
Cannot use null as default value for parameter $a of type int
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'private' (T_PRIVATE), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Cannot use null as default value for parameter $a of type int in Standard input code on line 3
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
                        "name": "a",
                        "span": {
                          "start": 60,
                          "end": 62
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
                              "start": 56,
                              "end": 59
                            }
                          }
                        },
                        "span": {
                          "start": 56,
                          "end": 59
                        }
                      },
                      "default": {
                        "kind": "Null",
                        "span": {
                          "start": 65,
                          "end": 69
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 69
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
                "end": 73
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 75
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75
  }
}
