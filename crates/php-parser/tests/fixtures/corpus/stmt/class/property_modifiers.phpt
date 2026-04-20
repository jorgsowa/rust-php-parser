===config===
min_php=8.4
===source===
<?php
class Test {
    final public $prop;
    readonly int $prop;
    private static $prop;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                  "name": "prop",
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
                "end": 41
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 56,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 65
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 71,
                "end": 91
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
===php_error===
PHP Fatal error:  Cannot redeclare Test::$prop in Standard input code on line 4
