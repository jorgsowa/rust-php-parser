===source===
<?php
OBJ->a->b[] = 1;
===errors <=7.4===
'object access on a constant' requires PHP 8.0 or higher
Cannot use temporary expression in write context
===errors 8.0-8.5===
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 2
===php_error 8.0-8.5===
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "PropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "OBJ"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 6,
                                        "end": 9
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 6,
                                    "end": 9
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "a"
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
                              "end": 12
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 14,
                              "end": 15
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 15
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
