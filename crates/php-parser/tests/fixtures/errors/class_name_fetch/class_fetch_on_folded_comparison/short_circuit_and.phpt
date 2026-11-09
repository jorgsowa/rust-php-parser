===source===
<?php
echo (0 && $x)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on false
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type bool in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on false in Standard input code on line 2
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
                              "Int": 0
                            },
                            "span": {
                              "start": 12,
                              "end": 13
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 17,
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
