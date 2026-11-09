===source===
<?php
function f() {
    static $d = static::B;
}
===errors <=8.2===
"static::" is not allowed in compile-time constants
===errors >=8.3===
Cannot use "static" when no class scope is active
===php_error <=8.2===
PHP Fatal error:  "static::" is not allowed in compile-time constants in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use "static" when no class scope is active in Standard input code on line 3
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
                      "name": "d",
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
                                  "static"
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
