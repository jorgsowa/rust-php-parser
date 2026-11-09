===source===
<?php
class A {
    function __destruct(): void {}
}
===errors <=7.4===
Destructor A::__destruct() cannot declare a return type
===errors >=8.0===
Method A::__destruct() cannot declare a return type
===php_error <=7.4===
PHP Fatal error:  Destructor A::__destruct() cannot declare a return type in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Method A::__destruct() cannot declare a return type in Standard input code on line 3
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
                    "name": "__destruct",
                    "span": {
                      "start": 29,
                      "end": 39
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
                          "start": 43,
                          "end": 47
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 47
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
