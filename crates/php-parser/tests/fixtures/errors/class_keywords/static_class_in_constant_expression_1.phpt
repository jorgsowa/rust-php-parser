===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { const C = static::class; }
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
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 22,
                      "end": 23
                    }
                  },
                  "value": {
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
                                "start": 26,
                                "end": 32
                              }
                            }
                          },
                          "span": {
                            "start": 26,
                            "end": 32
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 34,
                            "end": 39
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 39
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 40
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
