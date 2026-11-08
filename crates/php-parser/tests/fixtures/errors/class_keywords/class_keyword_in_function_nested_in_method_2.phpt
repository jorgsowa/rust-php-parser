===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A { function f() { function g(): static {} } }
===errors <=7.4===
'static type' requires PHP 8.0 or higher
Cannot use "static" when no class scope is active
===errors >=8.0===
Cannot use "static" when no class scope is active
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC) in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Cannot use "static" when no class scope is active in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 25,
                      "end": 26
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Function": {
                          "name": {
                            "name": "g",
                            "span": {
                              "start": 40,
                              "end": 41
                            }
                          },
                          "params": [],
                          "body": [],
                          "return_type": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "static"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 45,
                                  "end": 51
                                }
                              }
                            },
                            "span": {
                              "start": 45,
                              "end": 51
                            }
                          },
                          "by_ref": false,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 54
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 56
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
