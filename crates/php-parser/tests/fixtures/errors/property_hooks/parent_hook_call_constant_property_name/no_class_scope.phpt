===source===
<?php
parent::${0}::get();
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
                  "StaticPropertyAccessDynamic": {
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
                        "VariableVariable": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "method": {
                "kind": {
                  "Identifier": "get"
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
