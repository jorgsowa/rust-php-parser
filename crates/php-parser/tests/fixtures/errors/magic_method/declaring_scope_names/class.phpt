===source===
<?php
namespace N;
class C { function __call($n, int $a) {} }
===errors >=8.0===
N\C::__call(): Parameter #2 ($a) must be of type array when declared
===php_error >=8.0===
PHP Fatal error:  N\C::__call(): Parameter #2 ($a) must be of type array when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 25,
              "end": 26
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
                      "start": 38,
                      "end": 44
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 45,
                          "end": 47
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 45,
                        "end": 47
                      }
                    },
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
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 49,
                              "end": 52
                            }
                          }
                        },
                        "span": {
                          "start": 49,
                          "end": 52
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 49,
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
                "start": 29,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
