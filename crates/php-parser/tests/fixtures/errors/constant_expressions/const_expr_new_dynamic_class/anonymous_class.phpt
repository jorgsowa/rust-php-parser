===source===
<?php
function c($a = new class {}) {}
===errors <=8.0===
'new in initializers' requires PHP 8.1 or higher
===errors >=8.1===
Cannot use anonymous class in constant expression
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot use anonymous class in constant expression in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 34
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 34
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 34
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
