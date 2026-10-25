===source===
<?php class A { static function __clone() {} }
===errors <=7.4===
Clone method A::__clone() cannot be static
===errors >=8.0===
Method A::__clone() cannot be static
===php_error <=7.4===
PHP Fatal error:  Clone method A::__clone() cannot be static in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Method A::__clone() cannot be static in Standard input code on line 1
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
                    "name": "__clone",
                    "span": {
                      "start": 32,
                      "end": 39
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
                "start": 16,
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
