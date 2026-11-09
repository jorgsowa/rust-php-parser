===source===
<?php
function f() {
    self::g();
}
===errors===
Cannot use "self" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "self" when no class scope is active in Standard input code on line 3
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
                "Expression": {
                  "kind": {
                    "StaticMethodCall": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "self"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 25,
                              "end": 29
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 29
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "g"
                        },
                        "span": {
                          "start": 31,
                          "end": 32
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 34
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 35
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
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
