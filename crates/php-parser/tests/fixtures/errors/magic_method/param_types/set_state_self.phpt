===source===
<?php
class A {
    static function __set_state(self $a) {}
}
===errors >=8.0===
A::__set_state(): Parameter #1 ($a) must be of type array when declared
===php_error >=8.0===
PHP Fatal error:  A::__set_state(): Parameter #1 ($a) must be of type array when declared in Standard input code on line 3
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
                    "name": "__set_state",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 53,
                          "end": 55
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "self"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 48,
                              "end": 52
                            }
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 52
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 55
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
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
