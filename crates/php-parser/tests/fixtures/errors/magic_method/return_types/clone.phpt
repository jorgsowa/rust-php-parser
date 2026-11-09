===source===
<?php
class A {
    function __clone(): int {}
}
===errors <=7.4===
Clone method A::__clone() cannot declare a return type
===errors >=8.0===
A::__clone(): Return type must be void when declared
===php_error <=7.4===
PHP Fatal error:  Clone method A::__clone() cannot declare a return type in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  A::__clone(): Return type must be void when declared in Standard input code on line 3
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
                    "name": "__clone",
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
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 40,
                          "end": 43
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 43
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
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
