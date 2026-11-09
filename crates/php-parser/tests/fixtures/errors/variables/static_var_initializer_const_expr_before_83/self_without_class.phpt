===source===
<?php
function f() {
    static $a = self::B;
}
===errors >=8.3===
Cannot use "self" when no class scope is active
===php_error >=8.3===
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
                      "name": "a",
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
                              "Identifier": "B"
                            },
                            "span": {
                              "start": 43,
                              "end": 44
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 44
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 44
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 45
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
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
