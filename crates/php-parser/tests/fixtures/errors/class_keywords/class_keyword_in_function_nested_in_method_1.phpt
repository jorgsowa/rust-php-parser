===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f() { function g() { return self::C; } } }
===errors===
Cannot use "self" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 1
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
                        "Function": {
                          "name": {
                            "name": "g",
                            "span": {
                              "start": 40,
                              "end": 41
                            }
                          },
                          "params": [],
                          "body": [
                            {
                              "kind": {
                                "Return": {
                                  "kind": {
                                    "ClassConstAccess": {
                                      "class": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "self"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 53,
                                              "end": 57
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 53,
                                          "end": 57
                                        }
                                      },
                                      "member": {
                                        "kind": {
                                          "Identifier": "C"
                                        },
                                        "span": {
                                          "start": 59,
                                          "end": 60
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 53,
                                    "end": 60
                                  }
                                }
                              },
                              "span": {
                                "start": 46,
                                "end": 61
                              }
                            }
                          ],
                          "return_type": null,
                          "by_ref": false,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 63
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
