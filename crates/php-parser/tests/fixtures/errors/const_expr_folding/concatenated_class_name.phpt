===source===
<?php
const A = ('a' . 'b')::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
===errors 8.0-8.1===
(expression)::class cannot be used in constant expressions
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.1===
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
                          "Binary": {
                            "left": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 17,
                                "end": 20
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 23,
                                "end": 26
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 26
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 27
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "class"
                    },
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 34
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 34
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
