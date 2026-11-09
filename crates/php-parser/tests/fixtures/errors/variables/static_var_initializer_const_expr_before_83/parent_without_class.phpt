===source===
<?php
function f() {
    static $b = parent::B;
}
===errors >=8.3===
Cannot use "parent" when no class scope is active
===php_error >=8.3===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 3
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
                      "name": "b",
                      "span": {
                        "start": 32,
                        "end": 34
                      }
                    },
                    "default": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "parent"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 37,
                                  "end": 43
                                }
                              }
                            },
                            "span": {
                              "start": 37,
                              "end": 43
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "B"
                            },
                            "span": {
                              "start": 45,
                              "end": 46
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 46
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 46
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 47
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
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
