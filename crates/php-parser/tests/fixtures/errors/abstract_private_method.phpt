===source===
<?php
abstract class A {
    abstract private function f();
    abstract private static function g() {}
}
===errors >=8.4===
Abstract function A::f() cannot be declared private
Abstract function A::g() cannot be declared private
Abstract function A::g() cannot contain body
===php_error===
PHP Fatal error:  Abstract function A::f() cannot be declared private in Standard input code on line 3
===ast >=8.4===
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
                    "name": "f",
                    "span": {
                      "start": 55,
                      "end": 56
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 59
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 97,
                      "end": 98
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
                "start": 64,
                "end": 103
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 105
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 105
  }
}
