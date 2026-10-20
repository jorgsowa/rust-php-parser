===source===
<?php class Foo { public static protected(set) int $count = 0; }
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 1
===php_error 8.4===
PHP Fatal error:  Static property may not have asymmetric visibility in Standard input code on line 1
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
                      "start": 51,
                      "end": 57
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
                          "start": 47,
                          "end": 50
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 50
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 60,
                      "end": 61
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 61
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
