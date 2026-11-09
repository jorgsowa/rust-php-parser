===source===
<?php
class A {
    function __get(&$n) {}
}
===errors===
Method A::__get() cannot take arguments by reference
===php_error===
PHP Fatal error:  Method A::__get() cannot take arguments by reference in Standard input code on line 3
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
                    "name": "__get",
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 36,
                          "end": 38
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 38
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
