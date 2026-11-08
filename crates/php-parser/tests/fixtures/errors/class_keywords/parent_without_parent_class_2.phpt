===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f() { return new parent; } }
===errors >=8.0===
Cannot use "parent" when current class scope has no parent
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 1
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
                    "name": "f",
                    "span": {
                      "start": 25,
                      "end": 26
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 42,
                                      "end": 48
                                    }
                                  }
                                },
                                "span": {
                                  "start": 42,
                                  "end": 48
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 48
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 49
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
