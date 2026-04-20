===config===
min_php=8.5
===source===
<?php
class Foo {
    public function __construct(
        public readonly $x,
    ) {}
}
===errors===
readonly promoted property must have type
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
                      "type_hint": null,
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
                        "end": 77
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
                "end": 87
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 89
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89
  }
}
===php_error===
PHP Fatal error:  Readonly property Foo::$x must have type in Standard input code on line 4
