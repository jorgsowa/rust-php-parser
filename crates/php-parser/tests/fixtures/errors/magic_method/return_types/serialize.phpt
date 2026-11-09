===source===
<?php
class A {
    function __serialize(): ?array {}
}
===errors >=8.0===
A::__serialize(): Return type must be array when declared
===php_error >=8.0===
PHP Fatal error:  A::__serialize(): Return type must be array when declared in Standard input code on line 3
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
                    "name": "__serialize",
                    "span": {
                      "start": 29,
                      "end": 40
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 45,
                              "end": 50
                            }
                          }
                        },
                        "span": {
                          "start": 45,
                          "end": 50
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 50
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 53
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
