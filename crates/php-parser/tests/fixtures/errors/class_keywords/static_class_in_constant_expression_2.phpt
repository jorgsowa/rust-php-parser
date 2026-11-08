===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { public $p = static::class; }
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
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 23,
                      "end": 25
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                "start": 28,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 28,
                            "end": 34
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 36,
                            "end": 41
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 41
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 41
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
