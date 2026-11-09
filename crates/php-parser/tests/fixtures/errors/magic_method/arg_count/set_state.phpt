===source===
<?php
class A {
    static function __set_state() {}
}
===errors >=8.0===
Method A::__set_state() must take exactly 1 argument
===php_error >=8.0===
PHP Fatal error:  Method A::__set_state() must take exactly 1 argument in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 36,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 52
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
