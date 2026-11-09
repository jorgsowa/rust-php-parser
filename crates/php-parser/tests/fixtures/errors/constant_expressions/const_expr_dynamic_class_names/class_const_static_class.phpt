===source===
<?php
class Foo {
    const F = static::class;
}
===errors===
static::class cannot be used for compile-time class name resolution
===php_error===
PHP Fatal error:  static::class cannot be used for compile-time class name resolution in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "F",
                    "span": {
                      "start": 28,
                      "end": 29
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
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
