===source===
<?php
[(clone $a)->b] = $x;
===errors===
Assignments can only happen to writable values
===php_error <=8.4===
PHP Fatal error:  Assignments can only happen to writable values in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Parenthesized": {
                                    "kind": {
                                      "Clone": {
                                        "kind": {
                                          "Variable": "a"
                                        },
                                        "span": {
                                          "start": 14,
                                          "end": 16
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 8,
                                      "end": 16
                                    }
                                  }
                                },
                                "span": {
                                  "start": 7,
                                  "end": 17
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 19,
                                  "end": 20
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 21
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 24,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
