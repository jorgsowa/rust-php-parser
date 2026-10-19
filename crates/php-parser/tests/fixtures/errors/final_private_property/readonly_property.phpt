===config===
min_php=8.4
===source===
<?php
class A { final private readonly int $x; }
===errors===
Property cannot be both final and private
===php_error===
PHP Fatal error:  Property cannot be both final and private in Standard input code on line 2
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
                      "start": 43,
                      "end": 45
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true,
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 39,
                          "end": 42
                        }
                      }
                    },
                    "span": {
                      "start": 39,
                      "end": 42
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
