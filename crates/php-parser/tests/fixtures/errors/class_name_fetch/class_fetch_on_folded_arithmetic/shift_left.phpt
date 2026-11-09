===source===
<?php
echo (1 << 2)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on int in Standard input code on line 2
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
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 12,
                              "end": 13
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 17,
                              "end": 18
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 18
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 19
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 21,
                    "end": 26
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 26
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
