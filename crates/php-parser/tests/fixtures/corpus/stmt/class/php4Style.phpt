===source===
<?php

class A {
    var $foo;
    function bar() {}
    static abstract function baz() {}
}
===errors===
abstract method cannot contain a body
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "foo",
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
                "start": 21,
                "end": 29
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 35,
                "end": 52
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "baz",
                  "visibility": null,
                  "is_static": true,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 90
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
===php_error===
PHP Fatal error:  Class A declares abstract method baz() and must therefore be declared abstract in Standard input code on line 6
