===source===
<?php
interface I {
    final function h();
}
===errors===
Interface method I::h() must not be final
===php_error <=8.0===
PHP Fatal error:  Access type for interface method I::h() must be omitted in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Interface method I::h() must not be final in Standard input code on line 3
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
                    "name": "h",
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "modifiers": {
                    "is_final": true
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
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
