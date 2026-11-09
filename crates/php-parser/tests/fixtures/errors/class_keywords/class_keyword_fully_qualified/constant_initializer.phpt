===source===
<?php
class A {
    const X = \self::Y;
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
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
                                "start": 30,
                                "end": 35
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 35
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "Y"
                          },
                          "span": {
                            "start": 37,
                            "end": 38
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
