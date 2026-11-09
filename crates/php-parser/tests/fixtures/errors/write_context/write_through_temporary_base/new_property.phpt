===source===
<?php
(new A)->a = 1;
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
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 11,
                                      "end": 12
                                    }
                                  }
                                },
                                "span": {
                                  "start": 11,
                                  "end": 12
                                }
                              },
                              "args": []
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
                    "property": {
                      "kind": {
                        "Identifier": "a"
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
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 19,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
