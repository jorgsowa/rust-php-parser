===source===
<?php
class A {
    function __set($a, &$b) {}
}
===errors===
Method A::__set() cannot take arguments by reference
===php_error===
PHP Fatal error:  Method A::__set() cannot take arguments by reference in Standard input code on line 3
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
                        "name": "a",
                        "span": {
                          "start": 35,
                          "end": 37
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 37
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 40,
                          "end": 42
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 39,
                        "end": 42
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
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
