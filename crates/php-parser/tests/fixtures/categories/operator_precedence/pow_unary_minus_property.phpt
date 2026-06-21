===description===
PHP: `-$a->b ** 2` is `-(($a->b) ** 2)`. Member access binds tighter than `**`, which binds tighter than unary minus.
===source===
<?php
-$a->b ** 2;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Negate",
              "operand": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 7,
                              "end": 9
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
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
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 16,
                        "end": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
