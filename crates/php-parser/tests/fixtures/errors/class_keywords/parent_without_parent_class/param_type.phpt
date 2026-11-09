===source===
<?php
class A {
    function m(parent $p) {}
}
===errors >=8.0===
Cannot use "parent" when current class scope has no parent
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
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
                    "name": "m",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "p",
                        "span": {
                          "start": 38,
                          "end": 40
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "parent"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 31,
                              "end": 37
                            }
                          }
                        },
                        "span": {
                          "start": 31,
                          "end": 37
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 31,
                        "end": 40
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
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
