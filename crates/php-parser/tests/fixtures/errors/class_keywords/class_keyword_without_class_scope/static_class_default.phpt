===source===
<?php
function f($b = static::class) {}
===errors===
Cannot use "static" when no class scope is active
===php_error===
PHP Fatal error:  Cannot use "static" when no class scope is active in Standard input code on line 2
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
          "params": [
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
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
                            "start": 22,
                            "end": 28
                          }
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 28
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 30,
                        "end": 35
                      }
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 35
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 35
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
