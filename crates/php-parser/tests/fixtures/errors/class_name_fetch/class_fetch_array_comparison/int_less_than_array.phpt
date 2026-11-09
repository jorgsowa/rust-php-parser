===source===
<?php
(1 < [])::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on true
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
                            "Int": 1
                          },
                          "span": {
                            "start": 7,
                            "end": 8
                          }
                        },
                        "op": "Less",
                        "right": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 11,
                            "end": 13
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 16,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
