===source===
<?php
const A = ('a' ? 'b' : 'c')::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors >=8.0===
(expression)::class cannot be used in constant expressions
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  (expression)::class cannot be used in constant expressions in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 17,
                                "end": 20
                              }
                            },
                            "then_expr": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 23,
                                "end": 26
                              }
                            },
                            "else_expr": {
                              "kind": {
                                "String": "c"
                              },
                              "span": {
                                "start": 29,
                                "end": 32
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 32
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 33
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "class"
                    },
                    "span": {
                      "start": 35,
                      "end": 40
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 40
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 40
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
