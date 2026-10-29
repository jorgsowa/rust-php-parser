===source===
<?php
class Foo {
    public readonly $bar;
}
===errors >=8.1===
Readonly property Foo::$bar must have type
===php_error >=8.1===
PHP Fatal error:  Readonly property Foo::$bar must have type in Standard input code on line 3
===ast <=8.0===
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
                    "name": "bar",
                    "span": {
                      "start": 38,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "readonly"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 29,
                          "end": 37
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 37
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
===ast >=8.1===
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
                    "name": "bar",
                    "span": {
                      "start": 38,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
