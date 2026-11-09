===source===
<?php
function f() {
    static $c = parent::class;
}
===errors===
Cannot use "parent" when no class scope is active
===php_error===
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
                      "name": "c",
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
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 45,
                              "end": 50
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 50
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 50
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 51
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
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
