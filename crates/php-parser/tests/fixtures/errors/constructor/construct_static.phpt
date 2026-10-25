===description===
PHP rejects a static __construct with "Method A::__construct() cannot be static".
===source===
<?php
class A {
    public static function __construct() {}
}
===errors <=7.4===
Constructor A::__construct() cannot be static
===errors >=8.0===
Method A::__construct() cannot be static
===php_error <=7.4===
PHP Fatal error:  Constructor A::__construct() cannot be static in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Method A::__construct() cannot be static in Standard input code on line 3
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
                    "name": "__construct",
                    "span": {
                      "start": 43,
                      "end": 54
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
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
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
