===source===
<?php
abstract class Foo {
    abstract public private(set) int $count {
        get;
        set;
    }
}
===errors <=8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=8.2===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 21,
              "end": 24
            }
          },
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
                  "name": {
                    "name": "count",
                    "span": {
                      "start": 64,
                      "end": 70
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private",
                    "is_abstract": true
                  },
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
