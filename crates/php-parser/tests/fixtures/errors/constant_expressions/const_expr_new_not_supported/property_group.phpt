===source===
<?php
class C {
    public $c, $d = new Foo;
}
===errors===
New expressions are not supported in this context
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  New expressions are not supported in this context in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "c",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 29
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 31,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 40,
                                "end": 43
                              }
                            }
                          },
                          "span": {
                            "start": 40,
                            "end": 43
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 31,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
