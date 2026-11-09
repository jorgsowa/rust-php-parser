===source===
<?php
function f() {
    echo parent::X;
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
                "Echo": [
                  {
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
                                "start": 30,
                                "end": 36
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 36
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "X"
                          },
                          "span": {
                            "start": 38,
                            "end": 39
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 39
                    }
                  }
                ]
              },
              "span": {
                "start": 25,
                "end": 40
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
        "end": 42
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42
  }
}
