===source===
<?php

class Foo {
    public $bar1;
    publi $foo;
    public $bar;
}
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
                  "name": "bar1",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 35,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "foo",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "publi"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 41,
                          "end": 47,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 47,
                      "start_line": 5,
                      "start_col": 4
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 41,
                "end": 51,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "bar",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 68,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 71,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71,
    "start_line": 1,
    "start_col": 0
  }
}
