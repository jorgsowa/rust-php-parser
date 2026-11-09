===source===
<?php
class A {
    function __construct(): never {}
}
===errors <=7.4===
Constructor A::__construct() cannot declare a return type
===errors >=8.0===
Method A::__construct() cannot declare a return type
===php_error <=7.4===
PHP Fatal error:  Constructor A::__construct() cannot declare a return type in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Method A::__construct() cannot declare a return type in Standard input code on line 3
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
                    "name": "__construct",
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
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 44,
                          "end": 49
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 49
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
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
