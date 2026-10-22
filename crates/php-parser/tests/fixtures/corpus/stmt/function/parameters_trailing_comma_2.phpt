===source===
<?php

class Foo
{
    function __construct($name, $value, )
    {
    }
}
===errors <=7.4===
'trailing comma in parameter list' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting variable (T_VARIABLE) in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 13,
              "end": 16
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
                      "start": 32,
                      "end": 43
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "name",
                        "span": {
                          "start": 44,
                          "end": 49
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 44,
                        "end": 49
                      }
                    },
                    {
                      "name": {
                        "name": "value",
                        "span": {
                          "start": 51,
                          "end": 57
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 51,
                        "end": 57
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 72
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 74
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 74
  }
}
