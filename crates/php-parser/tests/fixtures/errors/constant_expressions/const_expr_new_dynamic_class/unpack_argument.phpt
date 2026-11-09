===source===
<?php
function d($a = new Foo(...$x)) {}
===errors <=8.0===
'new in initializers' requires PHP 8.1 or higher
===errors >=8.1===
Argument unpacking in constant expressions is not supported
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Argument unpacking in constant expressions is not supported in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
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
                          "Spread": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 33,
                              "end": 35
                            }
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 35
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 22,
                  "end": 36
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 36
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
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
