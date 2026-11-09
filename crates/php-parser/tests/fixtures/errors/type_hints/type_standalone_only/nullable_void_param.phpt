===source===
<?php
function a(?void $a) {}
===errors===
Void can only be used as a standalone type
===php_error <=7.4===
PHP Fatal error:  void cannot be used as a parameter type in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Void can only be used as a standalone type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
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
                  "start": 23,
                  "end": 25
                }
              },
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 18,
                          "end": 22
                        }
                      }
                    },
                    "span": {
                      "start": 18,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 22
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 25
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
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
