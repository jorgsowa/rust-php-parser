===source===
<?php
class C {
    function __debugInfo(): string {}
}
===errors >=8.0===
C::__debugInfo(): Return type must be ?array when declared
===php_error >=8.0===
PHP Fatal error:  C::__debugInfo(): Return type must be ?array when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "__debugInfo",
                    "span": {
                      "start": 29,
                      "end": 40
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 44,
                          "end": 50
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 50
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
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
