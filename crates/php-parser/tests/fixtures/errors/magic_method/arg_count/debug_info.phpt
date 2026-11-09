===source===
<?php
class A {
    function __debugInfo($a) {}
}
===errors <=7.4===
Method A::__debuginfo() cannot take arguments
===errors >=8.0===
Method A::__debugInfo() cannot take arguments
===php_error <=7.4===
PHP Fatal error:  Method A::__debuginfo() cannot take arguments in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Method A::__debugInfo() cannot take arguments in Standard input code on line 3
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
                    "name": "__debugInfo",
                    "span": {
                      "start": 29,
                      "end": 40
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 41,
                          "end": 43
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 41,
                        "end": 43
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
