===source===
<?php
function f(?int $x = 1.5) {}
===errors <=7.4===
Default value for parameters with a int type can only be int or NULL
===errors >=8.0===
Cannot use float as default value for parameter $x of type ?int
===php_error <=7.4===
PHP Fatal error:  Default value for parameters with a int type can only be int or NULL in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Cannot use float as default value for parameter $x of type ?int in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 18,
                          "end": 21
                        }
                      }
                    },
                    "span": {
                      "start": 18,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 21
                }
              },
              "default": {
                "kind": {
                  "Float": 1.5
                },
                "span": {
                  "start": 27,
                  "end": 30
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 30
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
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
