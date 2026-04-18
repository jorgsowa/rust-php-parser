===config===
min_php=8.5
===source===
<?php class Foo { public static private(set) string $bar = 'x'; }
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
                  "name": "bar",
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": true,
                  "is_readonly": false,
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
