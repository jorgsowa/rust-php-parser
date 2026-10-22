===source===
<?php class Foo { public static private(set) string $bar = 'x'; }
===errors <=8.4===
'asymmetric visibility on static properties' requires PHP 8.5 or higher
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 1
===php_error 8.4===
PHP Fatal error:  Static property may not have asymmetric visibility in Standard input code on line 1
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
                    "name": "bar",
                    "span": {
                      "start": 52,
                      "end": 56
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
                  "default": {
                    "kind": {
                      "String": "x"
                    },
                    "span": {
                      "start": 59,
                      "end": 62
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 62
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}
