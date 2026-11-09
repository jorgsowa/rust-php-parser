===source===
<?php
class A {
    function __set(&$n, $v, $w): int {}
}
===errors <=7.4===
Method A::__set() must take exactly 2 arguments
===errors >=8.0===
Method A::__set() must take exactly 2 arguments
A::__set(): Return type must be void when declared
===php_error===
PHP Fatal error:  Method A::__set() must take exactly 2 arguments in Standard input code on line 3
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
                    "name": "__set",
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 36,
                          "end": 38
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 38
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 40,
                          "end": 42
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 40,
                        "end": 42
                      }
                    },
                    {
                      "name": {
                        "name": "w",
                        "span": {
                          "start": 44,
                          "end": 46
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 44,
                        "end": 46
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
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 55
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
