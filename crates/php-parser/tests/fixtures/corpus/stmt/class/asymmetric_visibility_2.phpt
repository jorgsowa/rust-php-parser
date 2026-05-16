===config===
min_php=8.4
===source===
<?php
class Test {
    private(set) private(set) $x;
    private(set) public(set) $x;
}
===errors===
cannot use multiple set-visibility modifiers
Property with asymmetric visibility must have type
cannot use multiple set-visibility modifiers
Property with asymmetric visibility must have type
Cannot redeclare property $x
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
                  "name": "x",
                  "visibility": null,
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 51
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "x",
                  "visibility": null,
                  "set_visibility": "Public",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 84
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 87
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87
  }
}
===php_error===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
