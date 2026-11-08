===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f() { parent::g(); } }
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
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
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
                              "method": {
                                "kind": {
                                  "Identifier": "g"
                                },
                                "span": {
                                  "start": 39,
                                  "end": 40
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 43
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
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
