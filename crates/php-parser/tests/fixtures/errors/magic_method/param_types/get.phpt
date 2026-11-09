===source===
<?php
class A {
    function __get(int $n) {}
}
===errors >=8.0===
A::__get(): Parameter #1 ($n) must be of type string when declared
===php_error >=8.0===
PHP Fatal error:  A::__get(): Parameter #1 ($n) must be of type string when declared in Standard input code on line 3
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
                          "start": 39,
                          "end": 41
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
                              "start": 35,
                              "end": 38
                            }
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 38
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 41
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
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
