===source===
<?php
#[Attr(function () {})]
function f() {}
===errors 8.0-8.4===
'closures in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Closures in constant expressions must be static
===php_error 8.0-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Closures in constant expressions must be static in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 39,
              "end": 40
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 30,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 39,
              "end": 40
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 12
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Closure": {
                          "is_static": false,
                          "by_ref": false,
                          "params": [],
                          "use_vars": [],
                          "return_type": null,
                          "body": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 27
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 28
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
