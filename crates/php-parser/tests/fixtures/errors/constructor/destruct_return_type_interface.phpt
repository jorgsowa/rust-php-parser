===source===
<?php
interface I {
    public function __DESTRUCT(): int;
}
===errors >=8.0===
Method I::__DESTRUCT() cannot declare a return type
===php_error >=8.0===
PHP Fatal error:  Method I::__DESTRUCT() cannot declare a return type in Standard input code on line 3
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
                    "name": "__DESTRUCT",
                    "span": {
                      "start": 40,
                      "end": 50
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 54,
                          "end": 57
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 57
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
