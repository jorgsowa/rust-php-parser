===source===
<?php
('4' / '2')::class;
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
                            "String": "4"
                          },
                          "span": {
                            "start": 7,
                            "end": 10
                          }
                        },
                        "op": "Div",
                        "right": {
                          "kind": {
                            "String": "2"
                          },
                          "span": {
                            "start": 13,
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
