===source===
<?php
function f() {
    static $f = new A;
}
===errors <=8.0===
'new in initializers' requires PHP 8.1 or higher
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
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
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 32,
                        "end": 34
                      }
                    },
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 41,
                                  "end": 42
                                }
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 42
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 42
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 42
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 43
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
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
