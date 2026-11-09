===source===
<?php
class Foo {
    public function m($h = static::class) {}
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 38,
                      "end": 39
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "h",
                        "span": {
                          "start": 40,
                          "end": 42
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
                                    "start": 45,
                                    "end": 51
                                  }
                                }
                              },
                              "span": {
                                "start": 45,
                                "end": 51
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "class"
                              },
                              "span": {
                                "start": 53,
                                "end": 58
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 45,
                          "end": 58
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 40,
                        "end": 58
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 62
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}
