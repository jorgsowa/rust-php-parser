===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f() { return \self::C; } }
===errors===
'\self' is an invalid class name
===php_error===
PHP Fatal error:  '\self' is an invalid class name in Standard input code on line 1
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
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "self"
                                    ],
                                    "kind": "FullyQualified",
                                    "span": {
                                      "start": 38,
                                      "end": 43
                                    }
                                  }
                                },
                                "span": {
                                  "start": 38,
                                  "end": 43
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "C"
                                },
                                "span": {
                                  "start": 45,
                                  "end": 46
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 46
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 47
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
