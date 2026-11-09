===source===
<?php
enum E {
    function f() { return parent::X; }
}
===errors <=7.4===
'enums' requires PHP 8.1 or higher
===errors 8.0===
'enums' requires PHP 8.1 or higher
Cannot use "parent" when current class scope has no parent
===errors >=8.1===
Cannot use "parent" when current class scope has no parent
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 28,
                      "end": 29
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
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
                                      "start": 41,
                                      "end": 47
                                    }
                                  }
                                },
                                "span": {
                                  "start": 41,
                                  "end": 47
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "X"
                                },
                                "span": {
                                  "start": 49,
                                  "end": 50
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 50
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 51
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 53
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 55
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55
  }
}
