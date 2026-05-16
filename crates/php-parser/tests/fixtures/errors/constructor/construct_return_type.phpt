===description===
PHP rejects __construct declaring a return type with
"Method A::__construct() cannot declare a return type".
===source===
<?php
class A {
    public function __construct(): self {}
}
===errors===
Method __construct() cannot declare a return type
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
===php_error===
PHP Fatal error:  Method A::__construct() cannot declare a return type in Standard input code on line 3
