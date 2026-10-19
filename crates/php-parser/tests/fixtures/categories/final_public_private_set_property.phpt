===config===
min_php=8.4
===source===
<?php
class A { final public private(set) int $x; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 46,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private",
                    "is_final": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 42,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 45
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
