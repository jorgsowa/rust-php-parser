===source===
<?php
(PHP_INT_SIZE == 8)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on bool
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type bool in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on true in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "PHP_INT_SIZE"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 7,
                                "end": 19
                              }
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 19
                          }
                        },
                        "op": "Equal",
                        "right": {
                          "kind": {
                            "Int": 8
                          },
                          "span": {
                            "start": 23,
                            "end": 24
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 24
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 25
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 27,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
