===description===
PHP rejects a return type on __construct with "Method A::__construct() cannot declare a return type".
===source===
<?php
class A {
    public function __construct(): self {}
}
===errors===
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
                      "start": 36,
                      "end": 47
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
                          "self"
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
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
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
