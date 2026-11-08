===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f() { static $x = static::class; } }
===errors <=8.2===
static::class cannot be used for compile-time class name resolution
===php_error <=8.2===
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
                                "start": 38,
                                "end": 40
                              }
                            },
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
                                          "start": 43,
                                          "end": 49
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 43,
                                      "end": 49
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "class"
                                    },
                                    "span": {
                                      "start": 51,
                                      "end": 56
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 43,
                                "end": 56
                              }
                            },
                            "span": {
                              "start": 38,
                              "end": 56
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 31,
                        "end": 57
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
