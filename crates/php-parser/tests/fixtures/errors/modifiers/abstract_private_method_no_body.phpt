===source===
<?php
abstract class A {
    abstract private function f();
}
===errors===
Abstract function A::f() cannot be declared private
===php_error===
PHP Fatal error:  Abstract function A::f() cannot be declared private in Standard input code on line 3
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
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
