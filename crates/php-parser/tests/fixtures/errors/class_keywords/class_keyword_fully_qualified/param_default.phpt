===source===
<?php
class A {
    function m($a = \self::X) {}
}
===errors===
'\self' is an invalid class name
===php_error===
PHP Fatal error:  '\self' is an invalid class name in Standard input code on line 3
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
                    "name": "m",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 31,
                          "end": 33
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
                                    "self"
                                  ],
                                  "kind": "FullyQualified",
                                  "span": {
                                    "start": 36,
                                    "end": 41
                                  }
                                }
                              },
                              "span": {
                                "start": 36,
                                "end": 41
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "X"
                              },
                              "span": {
                                "start": 43,
                                "end": 44
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 44
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 31,
                        "end": 44
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
