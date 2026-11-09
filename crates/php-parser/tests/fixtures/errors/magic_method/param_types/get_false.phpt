===source===
<?php
class B {
    function __get(false $n) {}
}
===errors <=7.4===
'false type' requires PHP 8.0 or higher
'false as standalone type' requires PHP 8.2 or higher
===errors 8.0-8.1===
'false as standalone type' requires PHP 8.2 or higher
B::__get(): Parameter #1 ($n) must be of type string when declared
===errors >=8.2===
B::__get(): Parameter #1 ($n) must be of type string when declared
===php_error <=7.4===
PHP Fatal error:  Cannot use 'false' as class name as it is reserved in Standard input code on line 3
===php_error 8.0-8.1===
PHP Fatal error:  False can not be used as a standalone type in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  B::__get(): Parameter #1 ($n) must be of type string when declared in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
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
                          "start": 41,
                          "end": 43
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "false"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 35,
                              "end": 40
                            }
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 40
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 35,
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
