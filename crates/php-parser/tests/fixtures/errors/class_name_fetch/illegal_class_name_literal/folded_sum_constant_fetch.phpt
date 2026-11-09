===source===
<?php
(1 + 1)::A;
===errors===
Illegal class name
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 2
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
                            "Int": 1
                          },
                          "span": {
                            "start": 11,
                            "end": 12
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 12
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 15,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
