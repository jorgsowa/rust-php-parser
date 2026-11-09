===source===
<?php
echo (1.5 | 2)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors 8.0===
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
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
                              "Float": 1.5
                            },
                            "span": {
                              "start": 12,
                              "end": 15
                            }
                          },
                          "op": "BitwiseOr",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 18,
                              "end": 19
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 19
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 20
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 22,
                    "end": 27
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 27
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
