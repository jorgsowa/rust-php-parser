===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php enum E { case A; function f() { return new parent; } }
===errors <=7.4===
'enums' requires PHP 8.1 or higher
===errors 8.0===
'enums' requires PHP 8.1 or higher
Cannot use "parent" when current class scope has no parent
===errors >=8.1===
Cannot use "parent" when current class scope has no parent
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 1
===php_error >=8.1===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 1
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
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 15,
                "end": 22
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 32,
                      "end": 33
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
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 49,
                                      "end": 55
                                    }
                                  }
                                },
                                "span": {
                                  "start": 49,
                                  "end": 55
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 45,
                            "end": 55
                          }
                        }
                      },
                      "span": {
                        "start": 38,
                        "end": 56
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
