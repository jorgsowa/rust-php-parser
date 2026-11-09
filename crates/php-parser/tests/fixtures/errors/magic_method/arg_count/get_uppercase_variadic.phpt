===source===
<?php
class B {
    function __GET(...$n) {}
}
===errors <=7.4===
Method B::__get() must take exactly 1 argument
===errors >=8.0===
Method B::__GET() must take exactly 1 argument
===php_error <=7.4===
PHP Fatal error:  Method B::__get() must take exactly 1 argument in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Method B::__GET() must take exactly 1 argument in Standard input code on line 3
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
                    "name": "__GET",
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
                          "start": 38,
                          "end": 40
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 40
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
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
