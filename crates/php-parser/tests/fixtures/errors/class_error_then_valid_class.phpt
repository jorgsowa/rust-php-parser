===source===
<?php class Foo { public function } class Bar { public int $x = 1; }
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
                        "start": 34,
                        "end": 34,
                        "start_line": 1,
                        "start_col": 34
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
                "end": 34,
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
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Bar",
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
                  "name": "x",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 55,
                          "end": 58,
                          "start_line": 1,
                          "start_col": 55
                        }
                      }
                    },
                    "span": {
                      "start": 55,
                      "end": 58,
                      "start_line": 1,
                      "start_col": 55
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 64,
                      "end": 65,
                      "start_line": 1,
                      "start_col": 64
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 48,
                "end": 65,
                "start_line": 1,
                "start_col": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 36,
        "end": 68,
        "start_line": 1,
        "start_col": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68,
    "start_line": 1,
    "start_col": 0
  }
}
