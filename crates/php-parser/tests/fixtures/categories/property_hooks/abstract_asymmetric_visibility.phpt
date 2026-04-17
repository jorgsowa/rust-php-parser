===config===
min_php=8.4
===source===
<?php
abstract class Foo {
    abstract public private(set) int $count {
        get;
        set;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": true,
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
                  "set_visibility": "Private",
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
                          "start": 60,
                          "end": 63
                        }
                      }
                    },
                    "span": {
                      "start": 60,
                      "end": 63
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 81,
                        "end": 85
                      }
                    },
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 94,
                        "end": 98
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 31,
                "end": 104
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 106
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 106
  }
}
