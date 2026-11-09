===source===
<?php
parent::$a::get();
===errors >=8.4===
Cannot use "parent" when no class scope is active
===php_error >=8.4===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "parent"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 6,
                            "end": 12
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 12
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 14,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "method": {
                "kind": {
                  "Identifier": "get"
                },
                "span": {
                  "start": 18,
                  "end": 21
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
