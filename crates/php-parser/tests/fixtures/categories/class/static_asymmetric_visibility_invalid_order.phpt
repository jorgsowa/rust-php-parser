===config===
min_php=8.5
===source===
<?php class Foo { private public(set) static int $count = 0; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "count",
                  "visibility": "Private",
                  "set_visibility": "Public",
                  "is_static": true,
                  "is_readonly": false,
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
===php_error===
PHP Fatal error:  Visibility of property Foo::$count must not be weaker than set visibility in Standard input code on line 1
