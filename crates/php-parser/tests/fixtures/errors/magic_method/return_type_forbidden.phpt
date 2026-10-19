===source===
<?php
class A {
    function __destruct(): void {}
    function __construct(): never {}
}
===errors===
Method A::__destruct() cannot declare a return type
Method A::__construct() cannot declare a return type
===php_error===
PHP Fatal error:  Method A::__destruct() cannot declare a return type in Standard input code on line 3
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
                    "name": "__destruct",
                    "span": {
                      "start": 29,
                      "end": 39
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 43,
                          "end": 47
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 47
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 50
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 64,
                      "end": 75
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 79,
                          "end": 84
                        }
                      }
                    },
                    "span": {
                      "start": 79,
                      "end": 84
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 55,
                "end": 87
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 89
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89
  }
}
