===source===
<?php
abstract class A {
    abstract private static function g() {}
}
===errors===
Abstract function A::g() cannot be declared private
Abstract function A::g() cannot contain body
===php_error===
PHP Fatal error:  Abstract function A::g() cannot be declared private in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 21,
              "end": 22
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
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 62,
                      "end": 63
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_static": true,
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
