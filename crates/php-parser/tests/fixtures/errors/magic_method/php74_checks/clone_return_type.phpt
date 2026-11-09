===source===
<?php
class A {
    function __clone(): void {}
}
===errors <=7.4===
Clone method A::__clone() cannot declare a return type
===php_error <=7.4===
PHP Fatal error:  Clone method A::__clone() cannot declare a return type in Standard input code on line 2
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
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 40,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 44
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
