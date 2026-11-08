===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A extends B { function f() { function g() { parent::h(); } } }
===errors===
Cannot use "parent" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 1
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Function": {
                          "name": {
                            "name": "g",
                            "span": {
                              "start": 50,
                              "end": 51
                            }
                          },
                          "params": [],
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
                                              "start": 56,
                                              "end": 62
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 56,
                                          "end": 62
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "h"
                                        },
                                        "span": {
                                          "start": 64,
                                          "end": 65
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 56,
                                    "end": 67
                                  }
                                }
                              },
                              "span": {
                                "start": 56,
                                "end": 68
                              }
                            }
                          ],
                          "return_type": null,
                          "by_ref": false,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 70
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 72
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74
  }
}
