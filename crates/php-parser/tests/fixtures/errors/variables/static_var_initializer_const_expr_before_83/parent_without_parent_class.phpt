===source===
<?php
class A {
    function g() {
        static $x = parent::B;
    }
}
===errors >=8.3===
Cannot use "parent" when current class scope has no parent
===php_error >=8.3===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 4
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
                    "name": "g",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "x",
                              "span": {
                                "start": 50,
                                "end": 52
                              }
                            },
                            "default": {
                              "kind": {
                                "ClassConstAccess": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "parent"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 55,
                                          "end": 61
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 55,
                                      "end": 61
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "B"
                                    },
                                    "span": {
                                      "start": 63,
                                      "end": 64
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 55,
                                "end": 64
                              }
                            },
                            "span": {
                              "start": 50,
                              "end": 64
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 43,
                        "end": 65
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
