===source===
<?php
class A {
    private static function __get(int $n): int {}
}
===errors >=8.0===
Method A::__get() cannot be static
A::__get(): Parameter #1 ($n) must be of type string when declared
===php_error >=8.0===
PHP Fatal error:  Method A::__get() cannot be static in Standard input code on line 3
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
                    "name": "__get",
                    "span": {
                      "start": 44,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 54,
                          "end": 56
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
                              "start": 50,
                              "end": 53
                            }
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 53
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 56
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 59,
                          "end": 62
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 62
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
