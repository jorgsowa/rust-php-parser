===source===
<?php
class A {
    function __unserialize(callable $a) {}
}
===errors >=8.0===
A::__unserialize(): Parameter #1 ($a) must be of type array when declared
===php_error >=8.0===
PHP Fatal error:  A::__unserialize(): Parameter #1 ($a) must be of type array when declared in Standard input code on line 3
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
                          "start": 52,
                          "end": 54
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 43,
                              "end": 51
                            }
                          }
                        },
                        "span": {
                          "start": 43,
                          "end": 51
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 43,
                        "end": 54
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
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
