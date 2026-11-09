===source===
<?php class Foo { private public(set) static int $count = 0; }
===errors <=8.4===
'asymmetric visibility on static properties' requires PHP 8.5 or higher
Visibility of property Foo::$count must not be weaker than set visibility
===errors >=8.5===
Visibility of property Foo::$count must not be weaker than set visibility
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 1
===php_error 8.4===
PHP Fatal error:  Static property may not have asymmetric visibility in Standard input code on line 1
===php_error >=8.5===
PHP Fatal error:  Visibility of property Foo::$count must not be weaker than set visibility in Standard input code on line 1
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
                    "name": "count",
                    "span": {
                      "start": 49,
                      "end": 55
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "set_visibility": "Public",
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
                          "start": 45,
                          "end": 48
                        }
                      }
                    },
                    "span": {
                      "start": 45,
                      "end": 48
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 58,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
