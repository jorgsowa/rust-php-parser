===source===
<?php class Foo { public static int $count = 0; }
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
                  "set_visibility": null,
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
                          "start": 32,
                          "end": 35,
                          "start_line": 1,
                          "start_col": 32
                        }
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 35,
                      "start_line": 1,
                      "start_col": 32
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 45,
                      "end": 46,
                      "start_line": 1,
                      "start_col": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 46,
                "start_line": 1,
                "start_col": 18
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49,
    "start_line": 1,
    "start_col": 0
  }
}
