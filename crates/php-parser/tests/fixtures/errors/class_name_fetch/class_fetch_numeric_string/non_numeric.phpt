===source===
<?php
(1 + 'a')::class;
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
                            "String": "a"
                          },
                          "span": {
                            "start": 11,
                            "end": 14
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
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
            "start": 6,
            "end": 22
          }
        }
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
