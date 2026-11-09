===source===
<?php
interface I {
    function __destruct(): void;
}
===errors >=8.0===
Method I::__destruct() cannot declare a return type
===php_error >=8.0===
PHP Fatal error:  Method I::__destruct() cannot declare a return type in Standard input code on line 3
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
                    "name": "__destruct",
                    "span": {
                      "start": 33,
                      "end": 43
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
                          "start": 47,
                          "end": 51
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 51
                    }
                  },
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
