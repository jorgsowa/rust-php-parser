===source===
<?php
\FOO[0]->p = 1;
===errors <=8.5===
Cannot use temporary expression in write context
===php_error <=8.5===
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
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "FOO"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 6,
                                  "end": 10
                                }
                              }
                            },
                            "span": {
                              "start": 6,
                              "end": 10
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 11,
                              "end": 12
                            }
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
                        "Identifier": "p"
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
