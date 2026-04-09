===source===
<?php trait T { public function } class C { use T; }
===errors===
expected method name, found '}'
expected '(', found '}'
expected variable, found '}'
expected ')', found '}'
expected ';', found '}'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": "T",
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "<error>",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "<error>",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 32,
                        "start_line": 1,
                        "start_col": 32
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 32,
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
        "end": 33,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Class": {
          "name": "C",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 48,
                        "end": 49,
                        "start_line": 1,
                        "start_col": 48
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 44,
                "end": 51,
                "start_line": 1,
                "start_col": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 34,
        "end": 52,
        "start_line": 1,
        "start_col": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52,
    "start_line": 1,
    "start_col": 0
  }
}
