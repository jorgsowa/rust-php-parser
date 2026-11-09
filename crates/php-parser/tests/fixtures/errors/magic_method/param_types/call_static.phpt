===source===
<?php
class A {
    static function __callStatic(string $n, object $a) {}
}
===errors >=8.0===
A::__callStatic(): Parameter #2 ($a) must be of type array when declared
===php_error >=8.0===
PHP Fatal error:  A::__callStatic(): Parameter #2 ($a) must be of type array when declared in Standard input code on line 3
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
                    "name": "__callStatic",
                    "span": {
                      "start": 36,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 56,
                          "end": 58
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
                              "start": 49,
                              "end": 55
                            }
                          }
                        },
                        "span": {
                          "start": 49,
                          "end": 55
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 49,
                        "end": 58
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 67,
                          "end": 69
                        }
                      },
                      "type_hint": {
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
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 60,
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
