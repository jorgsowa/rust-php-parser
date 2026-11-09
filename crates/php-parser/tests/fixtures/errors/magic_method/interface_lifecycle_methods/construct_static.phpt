===source===
<?php
interface I {
    static function __construct();
}
===errors >=8.0===
Method I::__construct() cannot be static
===php_error >=8.0===
PHP Fatal error:  Method I::__construct() cannot be static in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 40,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
