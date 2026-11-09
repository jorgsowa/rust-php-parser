===source===
<?php
class Foo {
    public $g = static::BAR;
}
===errors===
"static::" is not allowed in compile-time constants
===php_error===
PHP Fatal error:  "static::" is not allowed in compile-time constants in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 29,
                      "end": 31
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
                                "start": 34,
                                "end": 40
                              }
                            }
                          },
                          "span": {
                            "start": 34,
                            "end": 40
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "BAR"
                          },
                          "span": {
                            "start": 42,
                            "end": 45
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 45
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
