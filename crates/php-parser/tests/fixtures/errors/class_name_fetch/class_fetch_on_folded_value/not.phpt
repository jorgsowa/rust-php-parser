===source===
<?php
echo (!1)::class;
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
                        "UnaryPrefix": {
                          "op": "BooleanNot",
                          "operand": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 13,
                              "end": 14
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 11,
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
              "start": 11,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
