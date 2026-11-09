===source===
<?php
interface I {
    abstract function i();
}
===errors===
Interface method I::i() must not be abstract
===php_error <=8.0===
PHP Fatal error:  Access type for interface method I::i() must be omitted in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Interface method I::i() must not be abstract in Standard input code on line 3
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
                    "name": "i",
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "modifiers": {
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
                "start": 24,
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
