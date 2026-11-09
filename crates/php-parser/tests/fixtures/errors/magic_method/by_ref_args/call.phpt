===source===
<?php
class A {
    function __call(string &$n, array $a) {}
}
===errors===
Method A::__call() cannot take arguments by reference
===php_error===
PHP Fatal error:  Method A::__call() cannot take arguments by reference in Standard input code on line 3
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
                          "start": 44,
                          "end": 46
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
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 46
                      }
                    },
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
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
