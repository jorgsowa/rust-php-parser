===source===
<?php
class A {
    static function __set_state(array $a): ?object {}
}
===errors >=8.0===
A::__set_state(): Return type must be object when declared
===php_error >=8.0===
PHP Fatal error:  A::__set_state(): Return type must be object when declared in Standard input code on line 3
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
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "object"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 60,
                              "end": 66
                            }
                          }
                        },
                        "span": {
                          "start": 60,
                          "end": 66
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 66
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
