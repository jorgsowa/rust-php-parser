===source===
<?php class A { public $a = 1, $b = 2, $c; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "a",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 28,
                      "end": 29,
                      "start_line": 1,
                      "start_col": 28
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 29,
                "start_line": 1,
                "start_col": 16
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "b",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 36,
                      "end": 37,
                      "start_line": 1,
                      "start_col": 36
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 37,
                "start_line": 1,
                "start_col": 16
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "c",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 41,
                "start_line": 1,
                "start_col": 16
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
