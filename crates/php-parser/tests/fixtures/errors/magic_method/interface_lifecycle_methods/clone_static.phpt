===source===
<?php
interface I {
    static function __clone(): void;
}
===errors >=8.0===
Method I::__clone() cannot be static
===php_error >=8.0===
PHP Fatal error:  Method I::__clone() cannot be static in Standard input code on line 3
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
                    "name": "__clone",
                    "span": {
                      "start": 40,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 51,
                          "end": 55
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 55
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
