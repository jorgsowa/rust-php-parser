===source===
<?php
function e($a = new Foo($x)) {}
===errors <=8.0===
'new in initializers' requires PHP 8.1 or higher
===errors >=8.1===
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
            "name": "e",
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
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 26,
                            "end": 29
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 29
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 30,
                              "end": 32
                            }
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 32
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 22,
                  "end": 33
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 33
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
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
