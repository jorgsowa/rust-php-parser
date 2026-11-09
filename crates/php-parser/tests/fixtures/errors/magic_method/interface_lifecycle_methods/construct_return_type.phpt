===source===
<?php
interface I {
    function __construct(): void;
}
===errors >=8.0===
Method I::__construct() cannot declare a return type
===php_error >=8.0===
PHP Fatal error:  Method I::__construct() cannot declare a return type in Standard input code on line 3
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
                      "start": 33,
                      "end": 44
                    }
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
                          "start": 48,
                          "end": 52
                        }
                      }
                    },
                    "span": {
                      "start": 48,
                      "end": 52
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 53
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
