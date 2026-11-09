===source===
<?php
class C {
    public static $b = new Foo;
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
                    "name": "b",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
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
                                "start": 43,
                                "end": 46
                              }
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 46
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 46
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
