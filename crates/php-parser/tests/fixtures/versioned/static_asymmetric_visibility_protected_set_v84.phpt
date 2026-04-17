===config===
parse_version=8.4
===source===
<?php class Foo { public static protected(set) int $count = 0; }
===errors===
'asymmetric visibility on static properties' requires PHP 8.5 or higher (targeting PHP 8.4)
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
                  "visibility": "Public",
                  "set_visibility": "Protected",
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
