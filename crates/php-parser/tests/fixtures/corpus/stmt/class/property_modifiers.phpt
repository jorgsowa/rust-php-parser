===source===
<?php
class Test {
    final public $prop;
    readonly $prop;
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
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 61
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
                "start": 67,
                "end": 87
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}
===php_error===
PHP Fatal error:  Cannot redeclare Test::$prop in Standard input code on line 4
Stack trace:
#0 {main}
