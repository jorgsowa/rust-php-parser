===source===
<?php
echo (Foo::class)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on string
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type string in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on string in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 12,
                                  "end": 15
                                }
                              }
                            },
                            "span": {
                              "start": 12,
                              "end": 15
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 17,
                              "end": 22
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 22
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 23
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 25,
                    "end": 30
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 30
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
