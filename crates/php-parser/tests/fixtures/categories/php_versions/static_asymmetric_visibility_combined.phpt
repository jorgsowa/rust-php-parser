===source===
<?php
class Foo {
    public static protected(set) int $count = 0;
    public static private(set) string $name = '';
}
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===php_error 8.4===
PHP Fatal error:  Static property may not have asymmetric visibility in Standard input code on line 3
===ast >=8.5===
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
                    "name": "count",
                    "span": {
                      "start": 55,
                      "end": 61
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Protected",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 51,
                          "end": 54
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 54
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 64,
                      "end": 65
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 65
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "name",
                    "span": {
                      "start": 105,
                      "end": 110
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 98,
                          "end": 104
                        }
                      }
                    },
                    "span": {
                      "start": 98,
                      "end": 104
                    }
                  },
                  "default": {
                    "kind": {
                      "String": ""
                    },
                    "span": {
                      "start": 113,
                      "end": 115
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 71,
                "end": 115
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 118
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 118
  }
}
