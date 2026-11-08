===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f($x = static::class) {} }
===errors===
static::class cannot be used for compile-time class name resolution
===php_error===
PHP Fatal error:  static::class cannot be used for compile-time class name resolution in Standard input code on line 1
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
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 27,
                          "end": 29
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "ClassConstAccess": {
                            "class": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "static"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 32,
                                    "end": 38
                                  }
                                }
                              },
                              "span": {
                                "start": 32,
                                "end": 38
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "class"
                              },
                              "span": {
                                "start": 40,
                                "end": 45
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 32,
                          "end": 45
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 27,
                        "end": 45
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
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
