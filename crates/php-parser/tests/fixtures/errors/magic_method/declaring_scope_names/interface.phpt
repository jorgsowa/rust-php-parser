===source===
<?php
namespace N;
interface I { function __toString(): int; }
===errors >=8.0===
N\I::__toString(): Return type must be string when declared
===php_error >=8.0===
PHP Fatal error:  N\I::__toString(): Return type must be string when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 29,
              "end": 30
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 42,
                      "end": 52
                    }
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
                          "start": 56,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 19,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
