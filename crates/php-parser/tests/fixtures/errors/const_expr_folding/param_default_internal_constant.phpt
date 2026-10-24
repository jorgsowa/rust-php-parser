===source===
<?php
function f($a = PHP_INT_MAX ?? $x) {}
===errors===
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
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
                "name": "a",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "PHP_INT_MAX"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 22,
                            "end": 33
                          }
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 33
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 39
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 39
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
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
