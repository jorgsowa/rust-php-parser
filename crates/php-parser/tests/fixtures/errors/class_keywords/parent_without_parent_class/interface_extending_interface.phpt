===source===
<?php
interface I extends J {
    function f(): parent;
}
===errors >=8.0===
Cannot use "parent" when current class scope has no parent
===php_error >=8.0===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
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
          "extends": [
            {
              "parts": [
                "J"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 26,
                "end": 27
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 48,
                          "end": 54
                        }
                      }
                    },
                    "span": {
                      "start": 48,
                      "end": 54
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 34,
                "end": 55
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
