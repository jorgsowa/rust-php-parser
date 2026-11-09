===source===
<?php
function f() {
    static $c = self::class;
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
                                  "self"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 37,
                                  "end": 41
                                }
                              }
                            },
                            "span": {
                              "start": 37,
                              "end": 41
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 43,
                              "end": 48
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 48
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 48
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 49
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
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
