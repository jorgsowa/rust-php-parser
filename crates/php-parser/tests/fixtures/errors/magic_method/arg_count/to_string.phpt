===source===
<?php
class A {
    function __toString($a = 1) {}
}
===errors <=7.4===
Method A::__tostring() cannot take arguments
===errors >=8.0===
Method A::__toString() cannot take arguments
===php_error <=7.4===
PHP Fatal error:  Method A::__tostring() cannot take arguments in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Method A::__toString() cannot take arguments in Standard input code on line 3
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
                    "name": "__toString",
                    "span": {
                      "start": 29,
                      "end": 39
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 40,
                          "end": 42
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 45,
                          "end": 46
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 40,
                        "end": 46
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
