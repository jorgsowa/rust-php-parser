===source===
<?php class Foo { abstract string $bar; }
===errors===
properties cannot be abstract
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
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 33,
                          "start_line": 1,
                          "start_col": 27
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 33,
                      "start_line": 1,
                      "start_col": 27
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 38,
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
        "end": 41,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41,
    "start_line": 1,
    "start_col": 0
  }
}
