===source===
<?php
('1.5' * 2)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on float
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type float in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on float in Standard input code on line 2
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
                            "String": "1.5"
                          },
                          "span": {
                            "start": 7,
                            "end": 12
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 15,
                            "end": 16
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 19,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
