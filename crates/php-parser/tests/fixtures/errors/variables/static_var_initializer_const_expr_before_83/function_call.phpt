===source===
<?php
function f() {
    static $e = foo();
}
===errors <=8.2===
Constant expression contains invalid operations
===php_error <=8.2===
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
                      "name": "e",
                      "span": {
                        "start": 32,
                        "end": 34
                      }
                    },
                    "default": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 37,
                                  "end": 40
                                }
                              }
                            },
                            "span": {
                              "start": 37,
                              "end": 40
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
