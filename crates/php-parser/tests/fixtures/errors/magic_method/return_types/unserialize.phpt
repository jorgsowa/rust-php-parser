===source===
<?php
class A {
    function __unserialize(array $a): bool {}
}
===errors >=8.0===
A::__unserialize(): Return type must be void when declared
===php_error >=8.0===
PHP Fatal error:  A::__unserialize(): Return type must be void when declared in Standard input code on line 3
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
                    "name": "__unserialize",
                    "span": {
                      "start": 29,
                      "end": 42
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 49,
                          "end": 51
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
                              "start": 43,
                              "end": 48
                            }
                          }
                        },
                        "span": {
                          "start": 43,
                          "end": 48
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 43,
                        "end": 51
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "bool"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 54,
                          "end": 58
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 58
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 61
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
