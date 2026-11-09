===source===
<?php
class A {
    function __sleep(): string {}
}
===errors >=8.0===
A::__sleep(): Return type must be array when declared
===php_error >=8.0===
PHP Fatal error:  A::__sleep(): Return type must be array when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                    "name": "__sleep",
                    "span": {
                      "start": 29,
                      "end": 36
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
                          "start": 40,
                          "end": 46
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 46
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
