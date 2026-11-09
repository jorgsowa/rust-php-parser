===source===
<?php
function f() {
    echo Self::$y;
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
                "Echo": [
                  {
                    "kind": {
                      "StaticPropertyAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 30,
                                "end": 34
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 34
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "y"
                          },
                          "span": {
                            "start": 36,
                            "end": 38
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 38
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 39
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
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
