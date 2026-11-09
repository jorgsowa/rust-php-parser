===source===
<?php
class A {
    function __set($n, $v): mixed {}
}
===errors >=8.0===
A::__set(): Return type must be void when declared
===php_error >=8.0===
PHP Fatal error:  A::__set(): Return type must be void when declared in Standard input code on line 3
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
                        "name": "v",
                        "span": {
                          "start": 39,
                          "end": 41
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 39,
                        "end": 41
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "mixed"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 44,
                          "end": 49
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 49
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
