===config===
min_php=8.1
===source===
<?php
class Foo {
    public function __construct(
        public readonly readonly string $x,
    ) {}
}
===errors===
duplicate modifier 'readonly'
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
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 84,
                              "end": 90
                            }
                          }
                        },
                        "span": {
                          "start": 84,
                          "end": 90
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 59,
                        "end": 93
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 103
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 105
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105
  }
}
===php_error===
PHP Fatal error:  Multiple readonly modifiers are not allowed in Standard input code on line 4
