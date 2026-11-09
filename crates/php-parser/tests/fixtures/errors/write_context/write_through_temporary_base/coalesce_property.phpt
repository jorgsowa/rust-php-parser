===source===
<?php
($a ?? $b)->a = 1;
===errors===
Cannot use temporary expression in write context
===php_error===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "NullCoalesce": {
                              "left": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 7,
                                  "end": 9
                                }
                              },
                              "right": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 13,
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
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 22,
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
