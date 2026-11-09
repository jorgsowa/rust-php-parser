===source===
<?php
class C {
    static function __set_state(array $a): iterable {}
}
===errors >=8.0===
C::__set_state(): Return type must be object when declared
===php_error >=8.0===
PHP Fatal error:  C::__set_state(): Return type must be object when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                          "start": 54,
                          "end": 56
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 48,
                              "end": 53
                            }
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 53
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 56
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "iterable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 59,
                          "end": 67
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 67
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 70
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
