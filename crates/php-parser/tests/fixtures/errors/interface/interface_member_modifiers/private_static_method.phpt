===source===
<?php
interface I {
    private static function g();
}
===errors===
Access type for interface method I::g() must be public
===php_error <=8.0===
PHP Fatal error:  Access type for interface method I::g() must be omitted in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Access type for interface method I::g() must be public in Standard input code on line 3
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
                    "name": "g",
                    "span": {
                      "start": 48,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
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
