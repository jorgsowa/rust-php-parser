===source===
<?php
class A {
    function __call(string $n, int $a) {}
}
===errors >=8.0===
A::__call(): Parameter #2 ($a) must be of type array when declared
===php_error >=8.0===
PHP Fatal error:  A::__call(): Parameter #2 ($a) must be of type array when declared in Standard input code on line 3
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
                    "name": "__call",
                    "span": {
                      "start": 29,
                      "end": 35
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 43,
                          "end": 45
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
                              "start": 36,
                              "end": 42
                            }
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 42
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 45
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 51,
                          "end": 53
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
                              "start": 47,
                              "end": 50
                            }
                          }
                        },
                        "span": {
                          "start": 47,
                          "end": 50
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 47,
                        "end": 53
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
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
