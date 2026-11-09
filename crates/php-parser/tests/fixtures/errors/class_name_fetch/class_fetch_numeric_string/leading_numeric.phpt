===source===
<?php
(1 + '1a')::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
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
                        "op": "Add",
                        "right": {
                          "kind": {
                            "String": "1a"
                          },
                          "span": {
                            "start": 11,
                            "end": 15
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 18,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
