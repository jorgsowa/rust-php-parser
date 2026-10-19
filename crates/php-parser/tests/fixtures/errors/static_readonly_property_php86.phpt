===config===
min_php=8.6
===source===
<?php
class Foo {
    public static readonly int $x = 1;
}
===errors===
static properties cannot be readonly
Readonly property cannot have default value
===php_error===
PHP Fatal error:  Static property Foo::$x cannot be readonly in Standard input code on line 3
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
                    "name": "x",
                    "span": {
                      "start": 49,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true,
                    "is_readonly": true
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
                      "Int": 1
                    },
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 55
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
